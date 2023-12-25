let posts = new XMLHttpRequest();
posts.open('POST',"./server/get-posts-api.php",true);
posts.send();

posts.onreadystatechange = function()
{
  if (this.readyState == 4 && this.status == 200) {
    let postsResponse = JSON.parse(this.responseText);
    let postPlace = document.querySelector('.mid-body');
    postsResponse.forEach((post)=>{
      
      postPlace.innerHTML += `
  
      <div class="post-item">
      <div class="post-item-head">
          <div class="post-item-head-left">
              <img class="profile-picture-holder" src="/MitraPark/${
                imageResponse[0]["media_url"]
              }" alt="" srcset="">
          </div>
          <div class="post-item-head-right">
              <div class="post-user">
                  <span>${
                    userInfo["user_first_name"] +
                    " " +
                    userInfo["user_mid_name"] +
                    " " +
                    userInfo["user_last_name"]
                  }</span>
              </div>
              <div class="post-details">
                  <span>${post["post_visibility"]}</span>
                  <span>|</span>
                  <span>${post["published_time"]}</span>
              </div>
          </div>
      </div>
      <div class="post-item-body">
          <span>${post["post_text"]}</span>
          <img height="300px" src="./birthday.png" alt="" srcset="">
      </div>
      <div class="post-item-footer">
          <div class="like-container">
              <img height="20px" src="./heart-outline.svg">
              <span>${post["post_likes_count"]}</span>
          </div>
          <div class="comment-container">
              <img height="20px" src="./comment-outline.svg">
              <span>${post["post_comments_count"]}</span>
          </div>
      </div>
  </div>

`;
    })
  }
 
}
