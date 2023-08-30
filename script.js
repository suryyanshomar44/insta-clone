const searchInput = document.getElementById("searchInput");
const searchButton = document.getElementById("searchButton");
const searchResults = document.getElementById("searchResults");
const dropdown = document.getElementsByClassName("dropdown")[0];

searchButton.addEventListener("click", handleSearch);

function profilehandler(name) {
  searchInput.value = name;
  searchResults.innerHTML = "";
  dropdown.style.display = "none";

  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      document.getElementById("bodyContainer").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", `profile.php?name=${name}`, true);
  xmlhttp.send();
}

function userProfilehandler() {
  document.getElementById("bodyContainer").style.overflow = "hidden";
  let name = document.getElementById("username").value;
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      document.getElementById("bodyContainer").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", `profile.php?name=${name}`, true);
  xmlhttp.send();
}

function handleSearch() {
  const searchTerm = searchInput.value.trim();

  searchResults.innerHTML = "";

  if (searchTerm.length === 0) {
    return;
  }

  fetch(`search_users.php?search=${encodeURIComponent(searchTerm)}`)
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      data.forEach((user) => {
        const li = document.createElement("li");
        li.textContent = user;
        dropdown.style.display = "block";
        li.addEventListener("click", () => profilehandler(user));
        searchResults.appendChild(li);
      });
    });
}

function followbtn(event, id) {
  console.log("follow btn");
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      const button = document.getElementById("follow");
      button.style.backgroundColor = "grey";
      button.innerText = "following";
      button.style.color = "black";
      button.disabled = true;
      $("#cfriend").load(window.location.href + " #cfriend");
    }
  };
  xmlhttp.open("GET", `addfriend.php?id=${id}`, true);
  xmlhttp.send();
}

function fetchposts() {
  document.getElementById("bodyContainer").style.overflow = "scroll";
  let xmlhttp1 = new XMLHttpRequest();
  xmlhttp1.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("bodyContainer").innerHTML = this.responseText;
    }
  };
  xmlhttp1.open("GET", `cards.php`, true);
  xmlhttp1.send();
}

function likehandler(postid, likes) {
  console.log("postid " + postid + " likes " + likes);
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    console.log(this.responseText);
    if (this.readyState == 4 && this.status == 200) {
      var val = likes + 1;
      document.getElementById(`${postid}likes`).innerHTML = val + " likes";
    }
  };
  xmlhttp.open("GET", `updatelike.php?likes=${likes}&post_id=${postid}`, true);
  xmlhttp.send();
}

function commentCollapseHandler(id) {
  const commentSection = document.getElementById(`commentSection${id}`);
  if (commentSection.style.display === "none") {
    commentSection.style.display = "block";
  } else {
    commentSection.style.display = "none";
  }
}
function commentHandler(id) {
  let commentInput = document.getElementById(`commentInput${id}`);
  let commentSection = document.getElementById(`commentSection${id}`);
  let commentContainer = document.getElementsByClassName(`comments${id}`)[0];
  let username = document.getElementById("username").value;
  console.log(username);
  let comment = commentInput.value;
  console.log("New Comment:", comment);
  commentInput.value = "";
  commentSection.style.display = "none";
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    console.log(this.responseText);
    if (this.readyState == 4 && this.status == 200) {
      let newcomment = document.createElement("div");
      newcomment.className = "comment";
      newcomment.textContent = `${username} : ${comment}`;
      commentContainer.appendChild(newcomment);
    }
  };
  xmlhttp.open(
    "GET",
    `updatecomment.php?id=${id}&comment=${comment}&username=${username}`,
    true
  );
  xmlhttp.send();
}
