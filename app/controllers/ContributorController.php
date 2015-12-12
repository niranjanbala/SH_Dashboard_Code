<?php

class ContributorController extends \BaseController {

	public function contributorDashboard()
	{
		$post_count = Post::where('user_id',Auth::user()->id)->count();
		return View::make('contributor.contributorDashboard')->withPage('dashboard')
			->with('post_count',$post_count);
	}

	public function contributorPost()
	{
		$post = Post::where('user_id',Auth::user()->id)->paginate(10);
		return View::make('contributor.post')
			->with('title',"Posts Management")
			->with('page', "posts")
			->with('posts',$post);
	}

	public function deletePost($id)
	{
		$post = Post::where('id',$id)->delete();
		if($post)
		{
			return Redirect::back()->with('flash_success',"Deleted successfully");
		}
		else
		{
			return Redirect::back()->with('flash_error',"Something went wrong");
		}
	}

	public function addPost()
	{
		$category = Category::all();
        $details = get_user_details(Auth::user()->id);
		return View::make('contributor.addPost')
			->with('title',"Posts Management")
			->with('page', "posts")
			->with('details',$details)
			->with('category',$category);
	}

	public function editPost($id)
	{
		$category = Category::all();
		$post = Post::find($id);
		$cate = explode(',', $post->category);
		return View::make('contributor.editPost')
			->with('title',"Posts Management")
			->with('page', "posts")
			->with('category',$category)
			->with('post',$post)
			->with('cate',$cate);
	}

	public function addPostProcess()
	{
		$category = Input::get('category');
		$title = Input::get('title');
		$post_img = Input::file('post_img');
		$url = Input::get('url');
		$title_tag = Input::get('title_tag');
		$meta_des = Input::get('meta_des');
		$share_link = Input::get('share_link');
		$share_cat = Input::get('share_cat');
		$author = Input::get('author');
		$publisher = Input::get('publisher');
		$pub_date = Input::get('pub_date');
		$pub_time = Input::get('pub_time');

		$validator = Validator::make(
			array(
				'title' => $title,
				'url' => $url,
				'meta_des' => $meta_des,
				'category' => $category,
				'author' => $author,
				'publisher' => $publisher
			), array(
				'title' => 'required',
				'url' => 'required',
				'meta_des' => 'required',
				'category' => 'required',
				'author' => 'required',
				'publisher' => 'required'
			)
		);

		if ($validator->fails()) {
			$error_messages = $validator->messages()->all();
			return Redirect::back()->with('flash_errors', $error_messages);
		}
		else
		{
			if (Input::get('id') != "")
			{
				$post = Post::find(Input::get('id'));
				$post->title = $title;
				$post->des = Input::get('des');
				$post->url = $url;
				$post->meta_des = $meta_des;
				$post->publisher = $publisher;
				$post->author = $author;
				if($pub_date != "")
				$post->created_at = date('Y-m-d H:i:s', strtotime("$pub_date $pub_time"));

				$validator1 = Validator::make(
					array(
						'post_img' => $post_img,
					), array(
						'post_img' => 'required|mimes:jpeg,bmp,gif,png',
					)
				);

				if ($validator1->fails())
				{
					//do nothing
				}
				else
				{
					$file_name = seo_url($title).'-'.time();
					$post->des = Input::get('des');
					$ext = Input::file('post_img')->getClientOriginalExtension();
					Input::file('post_img')->move(public_path() . "/uploads", $file_name . "." . $ext);
					$local_url = $file_name . "." . $ext;

					// Upload to S3
					$s3_url = URL::to('/') . '/uploads/' . $local_url;

					$post->image = $s3_url;
				}
				$post->category = implode(',', $category);
				$post->save();
				if ($post) {
					return Redirect::route('contributorPost')->with('flash_success', "Post Updated");
				} else {
					return Redirect::back()->with('flash_error', "Something went wrong");
				}
			}
			else
			{
				$post = new Post;
				$post->title = $title;
				$post->is_approved = 0;
				$post->url = $url;
				$post->des = Input::get('des');
				$post->meta_des = $meta_des;
				$post->user_id = Auth::user()->id;
				$post->publisher = $publisher;
				$post->author = $author;

				$validator1 = Validator::make(
					array(
						'title_tag' => $title_tag,
						'post_img' => $post_img,
						'share_link' => $share_link,
						'share_cat' => $share_cat,
					), array(
						'title_tag' => '',
						'share_link' => '',
						'share_cat' => '',
						'post_img' => 'required|mimes:jpeg,bmp,gif,png',
					)
				);

				if ($validator1->fails()) {
					$error_messages = $validator->messages()->all();
					return Redirect::back()->with('flash_errors', $error_messages);
				}
				else
				{
					$file_name = seo_url($title).'-'.time();
					$ext = Input::file('post_img')->getClientOriginalExtension();
					Input::file('post_img')->move(public_path() . "/uploads", $file_name . "." . $ext);
					$local_url = $file_name . "." . $ext;

					// Upload to S3
					$s3_url = URL::to('/') . '/uploads/' . $local_url;

					$post->image = $s3_url;

					$post->category = implode(',', $category);

					// $post->share_cat = $share_cat;

					// $link = str_replace(" ", "-", Input::get('share_link')) . '-' . rand(0, 99);

					// $post->link = $link;
					// $post->title_tag = $title_tag;
					$post->save();


					// if (Input::get('push_button') === 'yes') {
					// 	// checked

					// 	$response_array = array(
					// 		'success' => true,
					// 		'description' => $meta_des,
					// 		'image' => $s3_url,
					// 	);


					// 	send_notification($title,$response_array);
					// }


				}
				if ($post) {
					return Redirect::route('contributorPost')->with('flash_success', "Post created");
				} else {
					return Redirect::back()->with('flash_error', "Something went wrong");
				}
			}
		}
	}

	public function viewPost($id)
	{
		$view_post = Post::find($id);
		if($view_post)
		{
			$cat = Category::all();
			return View::make('viewPost')->withPost($view_post)->with('cats',$cat);
		}
		else
		{
			return Redirect::back()->with('flash_error', "Something went wrong");
		}
	}

	public function contributorProfile()
	{
		$admin = Auth::user();
		return View::make('contributor.profile')
			->with('title',"Flagged Posts")
			->with('page', "account")
			->with('admin',$admin);
	}

	public function contributorProfileProcess()
	{
		$validator = Validator::make(array(
			'first_name' => Input::get('first_name'),
			'last_name' => Input::get('last_name'),
			'email' => Input::get('email'),
		'author_name' => Input::get('author_name')),
			array('first_name' => 'required',
				'last_name' => 'required',
				'author_name' => 'required',
				'email' => 'required|email'));
		if($validator->fails())
		{
			$error = $validator->messages()->all();
			return Redirect::back()->with('flash_errors',$error);
		}
		else {
			$first_name = Input::get('first_name');
			$last_name = Input::get('last_name');
			$email = Input::get('email');
			$author_name = Input::get('author_name');

			$admin = User::find(Auth::user()->id);
			$admin->first_name = $first_name;
			$admin->last_name = $last_name;
			$admin->email = $email;
			$admin->author_name = $author_name;
			$admin->save();

			if ($admin) {
				return Redirect::back()->with('flash_success', "Updated successfully");
			} else {
				return Redirect::back()->with('flash_error', "Something went wrong");
			}
		}
	}

	public function contributorPassword()
	{
		$validator = Validator::make(array(
			'password' => Input::get('password'),
			'con_password' => Input::get('con_password')),
			array('password' => 'required',
				'con_password' => 'required'));
		if($validator->fails())
		{
			$error = $validator->messages()->all();
			return Redirect::back()->with('flash_errors',$error);
		}
		else
		{
			$password = Input::get('password');
			$con_password = Input::get('con_password');
			$admin = User::find(Auth::user()->id);
			$admin->password = Hash::make($con_password);
			$admin->save();

			if ($admin) {
				return Redirect::back()->with('flash_success', "Updated successfully");
			} else {
				return Redirect::back()->with('flash_error', "Something went wrong");
			}
		}
	}

	public function profilePics()
	{
		$validator = Validator::make(array(
			'profile_pic' => Input::file('profile_pic')),
			array('profile_pic' => 'required|mimes:jpeg,bmp,gif,png'));
		if($validator->fails())
		{
			$error = $validator->messages()->all();
			return Redirect::back()->with('flash_errors',$error);
		}
		else
		{
			$admin = User::find(Auth::user()->id);
			$file_name = seo_url(Setting::get('sitename')).'-'.Auth::user()->author_name.'-'.time();
			$ext = Input::file('profile_pic')->getClientOriginalExtension();
			Input::file('profile_pic')->move(public_path() . "/uploads", $file_name . "." . $ext);
			$local_url = $file_name . "." . $ext;
			$s3_url = URL::to('/') . '/uploads/' . $local_url;
			$admin->profile_pic = $s3_url;
			$admin->save();

			if ($admin) {
				return Redirect::back()->with('flash_success', "Updated successfully");
			} else {
				return Redirect::back()->with('flash_error', "Something went wrong");
			}
		}
	}

}