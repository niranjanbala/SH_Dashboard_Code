<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{	
		//echo "Coming Soon";
		try{
      		 DB::connection()->getDatabaseName();
      
       		$post = Post::get();
			$cats = Category::orderBy('order_type')->get();
			// i++ page count
			counter('home');
			return View::make('index')->with('posts',$post)->with('cats',$cats);
        }

        catch(Exception $e){
       		return Redirect::route('install');
        }

	}

	public function selectCat($id)
	{
		$cats = Category::orderBy('order_type')->get();
		$posts = "SELECT * from posts where category LIKE '%$id%'";
		$post = DB::select(DB::raw($posts));
		if($post)
		{
			return View::make('category')->withCategory_id($id)->with('cats',$cats);
		}
		else
		{
			return Redirect::route('home');
		}

	}

	public function single($id,$data)
	{
		$segment = $data;
		$cats = Category::orderBy('order_type')->get();
		$post_details = Post::where('link',$segment)->where('is_approved',1)->first();
		$related = Post::rand()->take(3)->get();
		if($post_details)
		{	
			counter($segment);
			return View::make('single-post')->withRelated($related)->withPost($post_details)->with('cats',$cats);
		}
		else
		{
			return Redirect::route('home');
		}
		
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::route('login');
	}

	public function login(){
		return View::make('login');
	}

	public function processLogin()
	{
		$validator = Validator::make(array(
			'email' => Input::get('email'),
			'password' => Input::get('password')),
			array('email' => 'required',
				'password' => 'required'));
		$email = Input::get('email');
		$password = Input::get('password');
		if($validator->fails())
		{
			$errors = $validator->messages()->all();
			return Redirect::back()->with('flash_errors',$errors);
		}
		else
		{
			if (Auth::attempt(array('email' => $email, 'password' => $password)))
			{
				$user = Auth::user();
				if($user->role_id == 2)
				{
					return Redirect::route('adminDashboard');
				}
				elseif($user->role_id == 1)
				{
					if($user->is_activated == 1)
					{
						return Redirect::route('moderateDashboard');
					}
					else
					{
						return Redirect::back()->with('flash_error',"Please activate your account, Check your mail or contact admin");
					}
				}
				elseif($user->role_id == 3)
				{
					if($user->is_activated == 1)
					{
						return Redirect::route('contributorDashboard');
					}
					else
					{
						return Redirect::back()->with('flash_error',"Please activate your account, Check your mail or contact admin");
					}
				}
				else
				{
					return Redirect::back()->with('flash_error',"something went wrong");
				}
			}
			else
			{
				return Redirect::back()->with('flash_error',"Invalid Email and Password");
			}
		}
	}

	public function processForgotpassword(){
		$email = Input::get('email');

		$validator = Validator::make(
			array(
				'email' => $email,
			), array(
				'email' => 'required|email',
			)
		);

		if ($validator->fails())
		{
			$error_messages = $validator->messages()->all();
			return Redirect::back()->with('flash_errors',$error_messages);
		}
		else
		{
			$user = User::where('email',$email)->first();
			if(!$user)
			{
				return Redirect::back()->with('flash_errors',"Email Id not found");
			}

			$new_password = time();
			$new_password .= rand();
			$new_password = sha1($new_password);
			$new_password = substr($new_password, 0, 8);
			$user->password = Hash::make($new_password);

			$subject = "Your New Password";
			$email_data['name'] = $user->author_name;
			$email_data['password'] = $new_password;
			$email_data['email'] = $user->email;
			$user->save();

			if($user)
			{
				Mail::send('emails.newmoderator', array('email_data' => $email_data), function ($message) use ($email, $subject) {
					$message->to($email)->subject($subject);
				});
				return Redirect::back()->with('flash_success',"your password changed and new password is sent to your email!");
			}else{
				return Redirect::back()->with('flash_errors',"something went wrong!");
			}
		}
	}

	public function forgot_password()
	{
		return View::make('forgot_password');
	}

	public function ajax_loading()
	{
		$offset = is_numeric(Input::get('offset')) ? Input::get('offset') : die();
        $postnumbers = is_numeric(Input::get('number')) ? Input::get('number') : die();
        $q = Input::get('query');


        Log::info('num'. $q);
        Log::info('offset'. $offset);

        $query = "";

        if($q == ""){
        $query = Post::orderBy('created_at','desc')->distinct()->where('is_approved',1)->limit($postnumbers)->offset($offset)->get();
        }elseif($q != ""){
        $query = Post::orderBy('created_at','desc')->distinct()->where('is_approved',1)->where('title','like', '%'.$q.'%')->orWhere('des','like', '%'.$q.'%')->limit($postnumbers)->offset($offset)->get();
        }
        $data = $query;


        foreach ($data as $post) {
				$cat_name = $post->share_cat;
				if($cat_name == ""){
					$cat_name = "news";
				}
                $fb = route("shareLink",array("id" => $cat_name,"data" => $post->link));
                $twitter = route("shareLink",array("id" => $cat_name,"data" => $post->link));
        	echo '<div class="col m6 s12 l4">
		          <div class="single-post card animated zoomIn">
		              <div class="card-image">
		                <a href="javascript:void(0);"><img src="'.$post->image.'"></a>
		                <span class="card-title">'.$post->title.'<em class="time-ago right">'.$post->created_at->diffForHumans().'</em></span>
		              </div>
		              <div class="card-content">
		               <p class="text-justify">'.$post->des.'</p>
		              </div>

		              <div class="card-action text-center">

		                <a target="_blank" href="http://www.facebook.com/sharer.php?u='.$fb.'" class="full waves-effect waves-light btn light-blue darken-4"><i class="fa fa-facebook left"></i>Share on Facebook</a>
		                <a target="_blank" href="http://twitter.com/share?text='.substr($post->title, 0, 30).'...&url='.$twitter.'" class="full waves-effect waves-light btn no-right-mar light-blue accent-3"><i class="fa fa-twitter left"></i>Share on Twitter</a>
		                <a target="_blank" href="'.$post->url.'" target="_blank" class="full-btn waves-effect waves-light btn no-right-mar mat-clr">Read More </a>

		              </div>
		             
		              
		          </div>  	
		      </div>';

        }
	}

	public function ajax_loading_category()
	{
		$offset = is_numeric(Input::get('offset')) ? Input::get('offset') : die();
        $postnumbers = is_numeric(Input::get('number')) ? Input::get('number') : die();
        $id = Input::get('category_id');

        Log::info('num'. $postnumbers);
        Log::info('offset'. $offset);

        $query = Post::orderBy('created_at','desc')->distinct()->where('is_approved',1)->where('category', 'LIKE', '%'.$id.'%')->limit($postnumbers)->offset($offset)->get();
        
        $data = $query;

        foreach ($data as $post) {
				$cat_name = $post->share_cat;
                $fb = route("shareLink",array("id" => $cat_name,"data" => $post->link));
                $twitter = route("shareLink",array("id" => $cat_name,"data" => $post->link));
        	echo '<div class="col m6 s12 l4">
		          <div class="single-post card animated zoomIn">

		              <div class="card-image">
		                <a href="javascript:void(0);"><img src="'.$post->image.'"></a>
		                <span class="card-title">'.$post->title.'<em class="time-ago right">'.$post->created_at->diffForHumans().'</em></span>
		              </div>
		              <div class="card-content">
		               <p class="text-justify">'.$post->des.'</p>
		              </div>

		              <div class="card-action text-center">

		                <a target="_blank" href="http://www.facebook.com/sharer.php?u='.$fb.'" class="full waves-effect waves-light btn light-blue darken-4"><i class="fa fa-facebook left"></i>Share on Facebook</a>
		                <a target="_blank" href="http://twitter.com/share?text='.substr($post->title, 0, 30).'...&url='.$twitter.'" class="full waves-effect waves-light btn no-right-mar light-blue accent-3"><i class="fa fa-twitter left"></i>Share on Twitter</a>
		                <a target="_blank" href="'.$post->url.'" target="_blank" class="full-btn waves-effect waves-light btn no-right-mar mat-clr">Read More </a>

		              </div>
		             
		              
		          </div>  	
		      </div>';

        }
	}

	public function install()
	{
		try{
	      DB::connection()->getDatabaseName();
	      
			$count = User::where('role_id',2)->count();
			if($count == 0){
	    		return View::make('install');
	    	}else{
	    		return Redirect::to('/');
	    	}
    	}

    	catch(Exception $e){
       		return View::make('install');
        }
    }

    public function install_submit()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        $admin_username = Input::get('admin_username');
        $admin_password = Input::get('admin_password');
        $sitename = Input::get('sitename');
        $database_name = Input::get('database_name');
        $picture = Input::file('picture');
        $mandrill_username = Input::get('mandrill_username');
        $mandrill_secret = Input::get('mandrill_secret');
        $timezone = Input::get('timezone');


        $validator = Validator::make(
            array(
                'password' => $password,
                'username' => $username,
                'database_name' => $database_name,
                'admin_username' => $admin_username,
                'admin_password' => $admin_password,
                'sitename' => $sitename,
                'picture' => $picture,
                'mandrill_username' => $mandrill_username,
                'timezone' => $timezone,
                'mandrill_secret' => $mandrill_secret,
                
            ), array(
                'password' => '',
                'username' => 'required',
                'sitename' => 'required',
                'database_name' => 'required',
                'admin_password' => 'required',
                'admin_username' => 'required',
                'mandrill_username' => 'required',
                'mandrill_secret' => 'required',
                'timezone' => 'required',
                'picture' => 'mimes:png,jpg'
            )
        );

        if ($validator->fails())
        {
            $error_messages = $validator->messages()->all();
            return Redirect::back()->with('flash_errors',$error_messages);
        }
        else
        {
            $file_name = time();
            $file_name .= rand();
            $ext = Input::file('picture')->getClientOriginalExtension();
            Input::file('picture')->move(public_path() . "/uploads", $file_name . "." . $ext);
            $local_url = $file_name . "." . $ext;
            $s3_url = URL::to('/') . '/uploads/' . $local_url;

            Setting::set('sitename',$sitename);
            Setting::set('footer',"Powered by Appoets");
            Setting::set('username',$username);
            Setting::set('password',$password);
            Setting::set('database_name',$database_name);
            Setting::set('mandrill_secret',$mandrill_secret);
            Setting::set('mandrill_username',$mandrill_username);
            Setting::set('timezone',$timezone);
            Setting::set('logo',$s3_url);

            import_db($username,$password,'localhost',$database_name);

            $admin = new User;
            $admin->email = $admin_username;
            $admin->is_activated = 1;
            $admin->password = Hash::make($admin_password);
            $admin->role_id = 2;
            $admin->save();

            return Redirect::to('/');
        }
    }

    public function feed_collector(){


    	//  please dont change the categories id's else the application will collapse

    	$response = file_get_contents('http://read-api.newsinshorts.com/v1/news');
    	$response = json_decode($response);
    	$inc = 0;

    	foreach ($response->news_list as $key) {
    		$check_count = Post::where('timestamp',$key->created_at)->count();
    		if($check_count == 0){
	    		if($key->category_names){
	    			$getting_categories = array();
	    			if(in_array("entertainment", $key->category_names)){
	    				array_push($getting_categories, 6);
	    			}

	    			if(in_array("national", $key->category_names)){
	    				array_push($getting_categories, 1);
	    			}

	    			if(in_array("world", $key->category_names)){
	    				array_push($getting_categories, 7);
	    			}

	    			if(in_array("miscellaneous", $key->category_names)){
	    				array_push($getting_categories, 8);
	    			}

	    			if(in_array("sports", $key->category_names)){
	    				array_push($getting_categories, 4);
	    			}

	    			if(in_array("business", $key->category_names)){
	    				array_push($getting_categories, 2);
	    			}

	    			if(in_array("politics", $key->category_names)){
	    				array_push($getting_categories, 3);
	    			}

	    			if(in_array("startup", $key->category_names)){
	    				array_push($getting_categories, 5);
	    			}
	    		}

	    		$post = new Post;
				$post->title = $key->title;
				$post->is_approved = 1;
				// dnt remove the commanded lines
				
					// $url = $key->source_url;
					// if(file_get_contents($url)){
					// 	preg_match('/(Location:|URI:)(.*?)\n/', implode("\n", $http_response_header), $matches);
					// 	if (isset($matches[0]))
					// 	{
					// 	    $post->url = strtok($matches[2], '?');
					// 	}
					// }else{
						$post->url = $key->source_url;
					// }

				
				$post->des = $key->content;
				$link = str_replace(" ", "-", $key->title) . '-' . rand(0, 99);

				$post->link = $link;
				$post->title_tag = $key->title;
				$post->meta_des = $key->title;
				$content = file_get_contents($key->image_url);
				$file_name = time();
            	$file_name .= rand();
				file_put_contents(public_path() . "/uploads"."/".$file_name.".jpg", $content);

				$post->image = URL::to('/') . "/uploads"."/".$file_name.".jpg";
				$post->category= implode(',', $getting_categories);
				$post->timestamp = $key->created_at;
				$post->save();

				// if($inc == 5){
				// 	break;
				// }

    		}else{
    			break;
    		}
    		$inc++;
    	}
    }

	public function shareLink($id,$data)
	{

		$segment = $data;
		$cats = Category::orderBy('order_type')->get();
		$post_details = Post::where('link',$segment)->where('is_approved',1)->first();
		$related = Post::orderByRaw("RAND()")->where('is_approved',1)->take(2)->get();
		if($post_details)
		{
			counter($segment);
			return View::make('single-post')->withRelated($related)->withPost($post_details)->with('cats',$cats);
		}
		else
		{
			return Redirect::route('home');
		}
	}

}
