let Title = document.querySelector("#title");
let loginBtn = document.querySelector("#loginbtn");
//Title Responsive
const windowWidth = window.innerWidth;
function navres(windowWidth) {
  if (windowWidth < 955) {
    Title.innerHTML = '<ion-icon name="book-outline"></ion-icon>';
    // loginBtn.innerHTML ="<ion-icon id='icon_log' name=\"arrow-forward-outline\"></ion-icon>"
  } else {
    Title.innerHTML = '<ion-icon name="book-outline"></ion-icon> BooksTrader';
    loginBtn.innerHTML = "Se connecter";
  }
}

let Comment_btns = document.querySelectorAll("#comment_btn");
let Post_comment = document.querySelectorAll("#Post_comment");
function comment_view(name, content, time) {
  return `
    <article style="padding:0;" class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900">
    <footer class="flex justify-between items-center mb-2">
        <div class="flex items-center">
            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
            

            <img
                    class="mr-2 w-10 h-10 rounded-full"
                    src="/Files/Images/ReaderIcon.png"
                    alt=""> ${name}</p>
            <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                    title="">${time}</time></p>
        </div>
        <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            type="button">
            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                </path>
            </svg>
            <span class="sr-only">Comment settings</span>
        </button>
        <!-- Dropdown menu -->
        <div id="dropdownComment1"
            class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                aria-labelledby="dropdownMenuIconHorizontalButton">
                <li>
                    <a href="#"
                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                </li>
            </ul>
        </div>
    </footer>
    <p class="text-gray-500 dark:text-gray-400">${content}</p>
    <div class="flex items-center mt-4 space-x-4">
        <button type="button"
            class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
            <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            Reply
        </button>
    </div>
    </article>
    
    
    `;
}

function Get_comment_api() {
  Comment_btns.forEach((CommentBtn) => {
    CommentBtn.onclick = function (e) {
      let section_comment =
        e.currentTarget.parentElement.parentElement.querySelector(
          "#commentSection"
        );
      let CommentsHolder =
        e.currentTarget.parentElement.parentElement.querySelector(
          "#CommentsHolder"
        );
      section_comment.style.display = "block";
      let post_id =
        e.currentTarget.parentElement.parentElement.querySelector("#id_post");
      
      let url = `http://localhost/comments?post_id=${post_id.value}`;
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          let comments = JSON.parse(xhttp.responseText);
          console.log(comments);
          CommentsHolder.innerHTML = "";
          if (comments !== false) {
            comments.forEach(function (comment) {
              let name = comment["User_name"];
              let time = comment["comment_time"];
              let content = comment["comment_content"];

              CommentsHolder.innerHTML += comment_view(name, content, time);
            });
          }
        }
      };
      xhttp.open("GET", url, true);
      xhttp.send();
    };
  });
}

Get_comment_api();

//ADD COMMENT
Post_comment.forEach(function (btn) {
  btn.onclick = function (e) {
    let input_coment = e.currentTarget.parentElement.querySelector("#comment");
    let CommentsHolder =
      e.currentTarget.parentElement.querySelector("#CommentsHolder");
    let post_id = e.currentTarget.parentElement.querySelector("#id_post");
    console.log(input_coment.value);
    if (input_coment.value.length !== 0) {

    let url = `http://localhost/post?comment=${input_coment.value}&Key=13&post_id=${post_id.value}`;
    input_coment.value = "";
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        //ajax grab data
        let url = `http://localhost/comments?post_id=${post_id.value}`;
        request = new XMLHttpRequest();
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            console.log("CHANGED");

            CommentsHolder.innerHTML = "";
            let comments = JSON.parse(this.responseText);
            // console.log(this.responseText)

            // Render the comments
            comments.forEach(function (comment) {
              let name = comment["User_name"];
              let time = comment["comment_time"];
              let content = comment["comment_content"];
              CommentsHolder.innerHTML += comment_view(name, content, time);
            });
          }
        };
        request.open("GET", url, true);
        request.send();
      }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
  }
};
});
