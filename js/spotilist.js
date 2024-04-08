function changepage(pagenumber) {
    if(pagenumber==0){
        document.getElementById('homepage').style.display = 'block';
        document.getElementById('profile').style.display = 'none';
        document.getElementById('datapage').style.display = 'none';
        document.getElementById('browse').style.display = 'none';
        document.getElementById('editprofile').style.display = 'none';
    }
    else if(pagenumber==1){
        document.getElementById('homepage').style.display = 'none';
        document.getElementById('profile').style.display = 'block';
        document.getElementById('datapage').style.display = 'none';
        document.getElementById('browse').style.display = 'none';
        document.getElementById('editprofile').style.display = 'none';
    }
    else if(pagenumber==2){
        document.getElementById('homepage').style.display = 'none';
        document.getElementById('profile').style.display = 'none';
        document.getElementById('datapage').style.display = 'block';
        document.getElementById('browse').style.display = 'none';
        document.getElementById('editprofile').style.display = 'none';
    }
    else if(pagenumber==3){
        document.getElementById('homepage').style.display = 'none';
        document.getElementById('profile').style.display = 'none';
        document.getElementById('datapage').style.display = 'none';
        document.getElementById('browse').style.display = 'block';
        document.getElementById('editprofile').style.display = 'none';
    }
    else {
        document.getElementById('homepage').style.display = 'none';
        document.getElementById('profile').style.display = 'none';
        document.getElementById('datapage').style.display = 'none';
        document.getElementById('browse').style.display = 'none';
        document.getElementById('editprofile').style.display = 'block';
    }
}

