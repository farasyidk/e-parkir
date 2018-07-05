// Initialize Firebase
var config = {
  apiKey: "AIzaSyDmpItyEybHqE7izg0vBknGBAZpl0AP1IU",
  authDomain: "eparkir-36b93.firebaseapp.com",
  databaseURL: "https://eparkir-36b93.firebaseio.com",
  projectId: "eparkir-36b93",
  storageBucket: "eparkir-36b93.appspot.com",
  messagingSenderId: "203085073024"
};
firebase.initializeApp(config);
let sign, uid;
//start auth
firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    // User is signed in.
    sign = "sign-in";
    uid = user.uid;
    
    $(document).ready(function(){
      $("#login").hide();
    });
  } else {
    // User is signed out.
    sign = "sign-out";
    $(document).ready(function(){
      $("#logout").hide();
      $("#login").show();
    });
    // FirebaseUI config.
      var uiConfig = {
          signInSuccessUrl: 'http://eparkir-36b93.firebaseapp.com/',
          signInOptions: [
              // Leave the lines as is for the providers you want to offer your users.
              firebase.auth.GoogleAuthProvider.PROVIDER_ID,
              firebase.auth.FacebookAuthProvider.PROVIDER_ID,
          ]
      };
      
      // Initialize the FirebaseUI Widget using Firebase.
      var ui = new firebaseui.auth.AuthUI(firebase.auth());
      // The start method will wait until the DOM is loaded.
      ui.start('#authentikasi', uiConfig);
  }
}, function(error) {
  console.log(error);
});
//end auth
const db = firebase.database();
const placesRef = db.ref().child('places'); 

placesRef.on("child_added", snap => {
  console.log("sampai");  
  let place = snap.val();
  var html = '<div class="col-md-4">'+
              '<div class="probootstrap-pricing">'+
                '<h2>'+place.name+'</h2>'+
                '<p class="probootstrap-price"><strong>'+place.status+'</strong></p>'+
                '<p><button id="prk'+snap.key+'" onClick="updatePlace('+'\''+place.status+'\''+','+snap.key+')" class="btn btn-black">'+place.tombol+'</button></p>'+
              '</div>'+
            '</div>';
  //Add the Injected HTML to the parent div called 'new'
  $("#places").append(html);
  if (place.status == "terisi" || uid != place.user) {
    var dis = "prk"+snap.key;
    document.getElementById(dis).disabled = 'true';
  }
});

function updatePlace(status,kunci) {
  if (sign == "sign-in") {
    var sts, tbl;
    if (status == 'kosong') {
        tbl = 'keluar';
        sts = 'terisi';
    } else {
        tbl = 'masuk';
        sts = 'kosong';
    }
    db.ref("places/"+kunci).update({status: sts, aksi:"down", tombol:tbl, user:uid});
    reload_page();
  } else {
    alert("silahkan login dahulu");
  }
    //return firebase.database().ref().update(updates);
}

function reload_page(){
   window.location.reload();
}

//event
$(document).ready(function(){
  $("#logout").click(function(){
    firebase.auth().signOut().then(function() {
      $("#logout").hide();
      $("#login").show();
    }, function(error) {
      // An error happened.
    });
  });
});