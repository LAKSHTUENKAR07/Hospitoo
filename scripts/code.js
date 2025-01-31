// remove notification
document.getElementById("show-alert").addEventListener("click", function () {
  document.getElementById("alert-box").style.display = "block";
});

document.getElementById("cancel-alert").addEventListener("click", function () {
  document.getElementById("alert-box").style.display = "none";
});

// background changer
function giffy1() {
  var x=document.getElementById("bo");
  x.style.backgroundImage="linear-gradient(rgba(0,0,0,0.2),rgba(0,0,0,0.2)),url('https://media2.giphy.com/media/3j1cQ31u1AQKqG1tU6/200w.webp?cid=ecf05e47oj3rceuitmtk0uhravdd21s1ecwiia13df0xzd7l&rid=200w.webp&ct=g')"; 
}

function pic1() {
  var x=document.getElementById("bo");
  x.style.backgroundImage="linear-gradient(rgba(0,0,0,0.2),rgba(0,0,0,0.2)),url(../content/3d6.jpg)"; 
}

//changing sign up form according to user entered.
function populate(s1){
  var s1 = document.getElementById(s1);
  var showingP = document.getElementById("patient");
  var showingA = document.getElementById("admin");
  var showingF = document.getElementById("family");
  // var outbox = document.getElementById("outbox");

  if (s1.value == "patient"){
    // outbox.style.display = "None";
    showingP.style.display = 'block';
    showingF.style.display = 'None';
    showingA.style.display = 'None';
  }
  else if (s1.value == "admin"){
    // outbox.style.display = "None";
    showingA.style.display = 'block';
    showingF.style.display = 'None';
    showingP.style.display = 'None';
  }
  else if (s1.value == "family"){
    showingF.style.display = 'block';
    showingP.style.display = 'None';
    showingA.style.display = 'None';
  }
  else{
    showingF.style.display = 'None';
    showingP.style.display = 'None';
    showingA.style.display = 'None';
    window.alert ("select any one relation");
  }
}