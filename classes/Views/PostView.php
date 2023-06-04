<?php

namespace classes\Views;
use classes\Models\Post;
use classes\View;

class PostView extends Post{

        public function GetCommentsbyid() {
            $post_id = $_GET["post_id"];
            print_r (json_encode($this->Getcommentsbypostid($post_id)));

        }

        public function Addcoment() {
            if(isset($_GET["Key"]) && isset($_GET["comment"])){
                if ($_GET["Key"] == 13){
                    $post_id = $_GET["post_id"] ;
                    $comment = $_GET["comment"];
                    $id_User = $_SESSION["User_id"];
                    $this->AddcomentToDb( $post_id ,$comment , $id_User );
                    
                    
                    $comments = $this->Getcommentsbypostid($post_id);
                    $filePath = '/data/Comments.json';
                    file_put_contents($filePath, $comments);


                }else {
                    return View::view('pagenotfound' , [])->render(false);
                }
            }
        }
        public function GetPosts() {
                $posts = $this->GetAllPosts();
           
                
                $Posts_Div ='';
                
                foreach($posts as $post){
                        $comments = $this->Getcommentsbypostid($post["Post_id"]);
                       
                        $Posts_Div .=' 
                        <div style="border-radius: 9px" class="container">

                        <div  class="item">
                           <div class=\'profileInfo\'>
                              <div style="background:white;" class=\'profileInfo-image\'>
                              <img src="/Files/Images/ReaderIcon.png"> 
                              </div>
                              <div class=\'profileInfo-text\'>
                                 <div>
                                    <span>'.$post["User_name"].'</span>
                                    <span class=\'profileInfo-nth font-gray\'>2nd</span>
                                 </div>
                                 <div>
                                    <span class=\'font-gray\'>Reader</span>
                                 </div>
                                 <div>
                                    <span class=\'font-gray\'>'.date('Y-m-d H:i:s', $post["Post_time"]).'</span>
                                 </div>
                              </div>
                           </div>
                           <div class=\'profileInfo-textSection\'>
                              <p>'.$post["Post_content"].'</p>
               
                           </div>
                           <div class=\'translationSection\'>
                              <span class=\'translationSection-translation font-bold\'>See translation</span>
                              <span>
                                 <span class=\'translationSection-likeIcon\' />
                                 <span class=\'translationSection-heartIcon\' />
                                 <span class=\'translationSection-clapIcon\' />
                                 <span class=\'translationSection-likeCount\'>115</span>
                                 <span>0 comments</span>
                              </span>
                           </div>
                        </div>
                        <form method="get">
                        <div class="item">


                           <div  class=\'userActionSection\'>
                           <button type="button" class="py-1 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-blue-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                           <ion-icon name="heart-outline"></ion-icon>
                           </button>
                           <button id="comment_btn" type="button" class="py-1 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                           <ion-icon style="" name="chatbubble-outline"></ion-icon>
                           </button>
                           <button type="button" class="py-1 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                           <ion-icon name="share-social-outline"></ion-icon>
                           </button>
                        </div>
                        <section id="commentSection"class="bg-white dark:bg-gray-900 py-8 lg:py-16">
                        <div  class="max-w-2xl mx-auto px-4">
                            
                            <form class="mb-6">
                                <div  style="width:90% ; padding :9px;"class="py-2 px-4 mb-4 bg-Blue rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                    <label for="comment" class="sr-only">Your comment</label>
                                    <input type="text"id="comment" rows="1"
                                        class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                        placeholder="Write a comment..." required></input>
                                </div>
                                <button id="Post_comment" style ="    position: relative;
                                top: -4.1rem;
                                left: 91%;
                                height: 45px;
                                font-size: 21px;"
                                 type="button" class="py-1 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-Blue rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-black dark:hover:bg-gray-700">
                                <ion-icon name="send-outline"></ion-icon>
                                </button>

                                
                            </form>
                            <input type="hidden" id="id_post" value="'.$post["Post_id"].'" >
                            <div id="CommentsHolder">

                            
                            </div>
                        </div>
                        </section>
                        </form>   
                        </div>
                     </div>'; 
                }
                return $Posts_Div;
        }

      
        
}