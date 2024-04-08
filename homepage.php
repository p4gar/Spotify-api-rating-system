<?php
require 'connection.php';

$sql = "SELECT COUNT(*) AS songCount FROM songlists"; // Count the number of rows in the table
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $songCount = $row['songCount'];
} else {
    $songCount = 0;
}

$con->close();
?>

<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:login.php');
}
?>

<?php
require 'connection.php';

$username = '';
$query = mysqli_query($con, "SELECT * FROM `accounts` WHERE `id`='$_SESSION[id]'") or die(mysqli_error());
$fetch = mysqli_fetch_array($query);

$username = $fetch['acc_username'];
$email = $fetch['acc_email'];
$password = $fetch['acc_password'];
$image = $fetch['acc_image'];
?>

<?php
$default_profile_photo = "icons/blankpfpicon.png"; // Path to default image

// Use profile_photo_path if available, otherwise use default image
$display_profile_photo = !empty($image) ? $image : $default_profile_photo;
?>

<?php
$default_photo = "images/addpicturehere.png";

$display_photo = !empty($image) ? $image : $default_photo;
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> <!-- Google Icon Fonts -->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <!-- mobile optimization -->
    <link rel="stylesheet" href="scss/main.css"> <!-- external css file -->
    <title>Spotilist</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="indigo lighten-2">

    <script src="js/spotilist.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <nav class="nav-center indigo lighten-1" role="navigation">
        <div class="nav-wrapper">
            <a href="" class="brand-logo left" onclick="changepage(0)">Spotilist</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="hide-on-med-and-down">
                <li id="homepagebtn"><a href="#" onclick="changepage(0)">Home</a></li>
                <li id="profilepagebtn"><a href="#" onclick="changepage(1)">Profile</a></li>
                <li id="datachartsbtn"><a href="#" onclick="changepage(2)">My Data Charts</a></li>
                <li id="browsebtn"><a href="#" onclick="changepage(3)">Browse</a></li>
            </ul>
        </div>
        <br>
    </nav>
    <div class="action">
        <div class="profile" onclick="menuToggle();">
            <img id="pfp" src="<?php echo $display_profile_photo; ?>" class="zoom-out">
        </div>
        <div class="menu white">
            <!-- fetches username from database -->
            <?php
            require 'connection.php';

            $query = mysqli_query($con, "SELECT * FROM `accounts` WHERE `id`='$_SESSION[id]'") or die(mysqli_error());
            $fetch = mysqli_fetch_array($query);

            echo '<span class="light-blue-text">' . $fetch['acc_username'] . '</span>';
            ?>
            <ul>
                <li class="white-text" onclick="changepage(4)"> <a href="#">Edit Profile</a></li>
                <li class="white-text"><a href="login.php">Logout?</a></li>
            </ul>
        </div>
    </div>
    <div id="homepage">
        <div class="title-box indigo accent-2">
            <h1>Welcome to Spotilist!, <br>Home to all your Spotify needs!</h1>
            <h2 style="font-size: smaller;">Scroll down to see a user's top items!; browse the latest songs and artists!
            </h2>
        </div>
        <div class="fullbento">
            <div class="category1">
                <div class="box2 column" id="box2">
                </div>
                <a href="https://open.spotify.com/track/4VqPOruhp5EdPBeR92t6lQ">
                    <div class="box5 column"
                        style="background-image: url('https://i.scdn.co/image/ab67616d0000b273b6d4566db0d12894a1a3b7a2');">
                    </div>
                </a>
                <a href="https://open.spotify.com/track/28MKy2umF5roXSqmUQ9eB7">
                    <div class="box6 column"
                        style="background-image: url('https://i.scdn.co/image/ab67616d0000b2731ad7b6eb6b0410e10402edeb');">
                    </div>
                </a>
                <div class="box3 column">
                    <a href="https://open.spotify.com/album/2T7DdrOvsqOqU9bGTkjBYu">
                        <img id="image1" src="https://i.scdn.co/image/ab67616d0000b273d8601e15fa1b4351fe1fc6ae"
                            style="width: 225px; height: auto; float: left; margin-top: 17px">
                    </a>
                    <div class="paragraph" style="text-align: left; margin-left: 17px">
                        <p>
                            Album Name: Human After All
                        </p>
                        <p>
                            Release Date: 2005-03-14
                        </p>
                        <p>
                            Artist Name: Daft Punk
                        </p>
                    </div>
                </div>
            </div>
            <div class="category2">
                <div class="box1 column">
                    <iframe style="border-radius:12px"
                        src="https://open.spotify.com/embed/album/6MJlXwm9rJV1sWBhNKIZG0?utm_source=generator"
                        width="100%" height="790" frameBorder="0" allowfullscreen=""
                        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                        loading="lazy"></iframe>
                </div>
            </div>
            <div class="category3">
                <a href="https://open.spotify.com/artist/2CIMQHirSU0MQqyYHq0eOx">
                    <div class="box7 column"
                        style="background-image: url('https://i.scdn.co/image/ab6761610000e5ebc5ceb05f152103b2b70d3b07'); margin-top: 20px;">
                    </div>
                </a>
                <a href="https://open.spotify.com/artist/57dN52uHvrHOxijzpIgu3E">
                    <div class="box8 column"
                        style="background-image: url('https://i.scdn.co/image/2f0c6c465a83cd196e651e3d4e7625ba799a6f60')">
                    </div>
                </a>
                <div class="box4 column">
                    <a href="https://open.spotify.com/album/5eQx95EHzDMcPurV2aByeh">
                        <img id="image1" src="https://i.scdn.co/image/ab67616d0000b273d71845bf949eb9130ef61481"
                            style="width: 225px; height: auto; float: left; margin-top: 17px">
                    </a>
                    <div class="paragraph" style="text-align: left; margin-left: 17px">
                        <p>
                            Album Name: Specter
                        </p>
                        <p>
                            Release Date: 2023-01-25
                        </p>
                        <p>
                            Artist Name: Hoshimachi Suisei
                        </p>
                    </div>
                </div>
                <a href="https://open.spotify.com/artist/2QoTOACSu8KOcy3YeyDLtN">
                    <div class="box9 column"
                        style="background-image: url('https://i.scdn.co/image/ab6761610000e5eb0e042a2d2dc5bbb565a8c2fd')"
                        ;>
                    </div>
                </a>
                <a href="https://open.spotify.com/album/5Z9iiGl2FcIfa3BMiv6OIw">
                    <div class="box10 column"
                        style="background-image: url('https://i.scdn.co/image/ab67616d0000b273baf89eb11ec7c657805d2da0')"
                        ;>

                    </div>
                </a>

            </div>
        </div>
    </div>
    <div id="profile">
        <div class="card clearfix">
            <img src="<?php echo $display_profile_photo; ?>" alt="alia1" style="width:100%">
            <!-- fetches username from database -->
            <?php
            require 'connection.php';

            $query = mysqli_query($con, "SELECT * FROM `accounts` WHERE `id`='$_SESSION[id]'") or die(mysqli_error());
            $fetch = mysqli_fetch_array($query);
            echo '<h1 class="nickname">' . $fetch['acc_username'] . '</h1>';
            ?>

            <!-- fetches ammount of rows in the songList database -->
            <p class="songAdded">Amount of songs added:
                <?php echo $songCount; ?>
            </p>
        </div>
        <div id="songList" class="flex-container">
            <div class="attributes">
                <ul class="songAttributes">
                    <li class="jacketattribute">Jacket</li>
                    <li class="name">Song Name</li>
                    <li class="artist">Artist</li>
                    <li class="length">Length</li>
                    <li class="album">Album</li>
                    <li class="rating">Rating Score</li>
                </ul>
            </div>
            <!-- Songs goes here -->


        </div>
    </div>
    <div id="datapage">
        <div class="container chartbox indigo lighten-1">
            <h2 class="white-text mycharts">My Charts</h2>
            <div class="chart-container">
                <canvas id="genrePieChart" width="700" height="500"></canvas>
            </div>
        </div>
    </div>
    </div>
    <div id="browse">
        <input type="hidden" id='hidden_token'>
        <div class="container">
            <form id="search-bar-form">
                <div class="input-field">
                    <input id="search" type="text" required></input>
                    <label class="label-icon"><i class="small material-icons">search</i></label>
                    <button id="submit-search" type="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="row">
            <h2 class="white-text col l3 offset-l2">Artists</h2>
        </div>
        <hr>
        <br><br>
        <div id="artist-section" class="row">

        </div>
        <div class="row">
            <h2 class="white-text col l3 offset-l2">Songs</h2>
        </div>
        <hr>
        <br><br>
        <div id="song-section" class="row">
        </div>
    </div>
    <div id="editprofile">
        <div class="editproftext white-text indigo accent-1">
            <h2>Edit your profile!</h2>
        </div>
        <div class="editform indigo accent-1">
            <form action="process_edit.php" method="post" enctype="multipart/form-data"
                class="innereditform indigo-text text-lighten-1">
                <div class="input-field" id="edituser">
                    <input type="text" name="text" id="text" required="required" value="<?php echo $username; ?>">
                    <label for="text">Enter your new username</label>
                </div>
                <div class="input-field" id="editemail">
                    <input type="email" name="email" id="email" required="required" value="<?php echo $email; ?>">
                    <label for="email">Enter your new email</label>
                </div>

                <div class="input-field" id="editpassword">
                    <input type="password" name="password" id="password" required="required"
                        value="<?php echo $password; ?>">
                    <label for="password">Enter your new password</label>
                    <span toggle="#password" class="field-icon toggle-password"><span
                            class="material-icons">visibility</span></span>
                </div>

                <div class="insertpfphere">
                    <label for="image" class="pfptextlabel white-text">Profile Picture Here : </label>
                    <div class="upload">
                        <img id="profileImage" src="<?php echo $display_photo; ?>" alt="Profile Photo">
                        <input id="imageUpload" type="file" name="profile_photo" accept="image/*"
                            style="display: none;">
                        <label for="imageUpload">Choose a Photo</label>
                        <span id="selectedFileName"></span>
                    </div>
                </div>

                <button class="bcktomain btn indigo accent-2 waves-effect waves-light"
                    onclick="changepage(0)">Cancel</button>
                <button class="submitbtn btn indigo accent-2 waves-effect waves-light" type="submit"
                    name="action">Submit</button>
            </form>
        </div>
    </div>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="#" onclick="changepage(0)">Home</a></li>
        <li><a href="#" onclick="changepage(1)">Profile</a></li>
        <li><a href="#" onclick="changepage(2)">My Data Charts</a></li>
        <li><a href="#" onclick="changepage(3)">Browse</a></li>
    </ul>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>



    <script>
        $('.dropdown-trigger').dropdown({
            constrainWidth: false,
        });
    </script>

    <script>
        var clicked = 0;

        $(".toggle-password").click(function (e) {
            e.preventDefault();

            $(this).toggleClass("toggle-password");
            if (clicked == 0) {
                $(this).html('<span class="material-icons">visibility_off</span >');
                clicked = 1;
            }
            else {
                $(this).html('<span class="material-icons">visibility</span >');
                clicked = 0;
            }

            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            }
            else {
                input.attr("type", "password");
            }
        });
    </script>

    <script>
        $("#profileImage").click(function (e) {
            $("#imageUpload").click();
        });
    </script>

    <script>
        function previewProfileImage(uploader) {
            //ensure a file was selected 
            if (uploader.files && uploader.files[0]) {
                var imageFile = uploader.files[0];
                var reader = new FileReader();
                reader.onload = function (e) {
                    //set the image data as source
                    $('#profileImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(imageFile);

            }
        }

        $("#imageUpload").change(function () {
            previewProfileImage(this);
        });
    </script>

    <script>
        document.getElementById('imageUpload').addEventListener('change', function () {
            var selectedFile = this.files[0];
            if (selectedFile) {
                document.getElementById('selectedFileName').textContent = selectedFile.name;
            } else {
                document.getElementById('selectedFileName').textContent = '';
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.sidenav').sidenav();
        });
    </script>

    <script>
        function menuToggle() {
            const toggleMenu = document.querySelector('.menu');
            toggleMenu.classList.toggle('active')
        }
    </script>

    <script>
        fetch('fetchGenreData.php')
            .then(response => response.json())
            .then(data => {
                // Use the fetched data to create the pie chart
                const genreNames = data.map(genre => genre.name);
                const genreCounts = data.map(genre => genre.count);


                //         Create the pie chart using Chart.js
                const ctx = document.getElementById('genrePieChart').getContext('2d');
                const genrePieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: genreNames,
                        datasets: [{
                            data: genreCounts,
                            backgroundColor: generateRandomColors(genreNames.length),
                        }],
                    },
                    options: {
                        responsive: false,
                        maintainAspectRatio: false,
                        legend: {
                            labels: {
                                fontColor: 'white',
                            },
                        },
                    },
                });
            })
            .catch(error => console.error('Error fetching data:', error));

        // for every genre, it creates a random color
        function generateRandomColors(count) {
            const colors = [];
            for (let i = 0; i < count; i++) {
                const randomColor = `#${Math.floor(Math.random() * 16777215).toString(16)}`;
                colors.push(randomColor);
            }
            return colors;
        }
    </script>


    <script>

        let selectedRating = 5; // Default rating value

        const addFunctionsToComponent = (id, trackName) => {
            // JavaScript to open and close the modal
            const openModalButton = document.getElementById(`openModalButton${id}`);
            const closeModalButton = document.getElementById(`closeModalButton${id}`);
            const ratingModal = document.getElementById(`ratingModal${id}`);

            openModalButton.addEventListener('click', () => {
                ratingModal.style.display = 'block';
            });

            closeModalButton.addEventListener('click', () => {
                ratingModal.style.display = 'none';
            });

            const ratingDropdown = document.getElementById(`ratingDropdown${id}`);
            const submitRatingButton = document.getElementById(`submitRatingButton${id}`);



            ratingDropdown.addEventListener('change', () => {
                selectedRating = parseInt(ratingDropdown.value);
            });

            submitRatingButton.addEventListener('click', () => {
                const selectedRating = parseInt(ratingDropdown.value);

                // Make an AJAX request to push the rating to the database
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'updateRating.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            alert(`You rated this ${selectedRating} out of 10! for song:  ${trackName}`);
                            ratingModal.style.display = 'none';
                            ratingDropdown.value = selectedRating;
                        } else {
                            console.error("Rating update failed:", response.message);
                        }
                    }
                };

                const data = `songId=${id}&rating=${selectedRating}`;
                xhr.send(data);
            });

            const deleteButton = document.getElementById(`deleteButton${id}`);
            deleteButton.addEventListener('click', () => {
                const confirmed = confirm("Are you sure you want to delete this song?");

                if (confirmed) {
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'deleteSong.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                alert(`Song deleted successfully!`);
                                // Remove the deleted song element from the DOM
                                const songElement = document.querySelector(`#songDetails${id}`);
                                if (songElement) {
                                    songElement.remove();
                                }
                            } else {
                                console.error("Deletion failed:", response.message);
                            }
                        }
                    };

                    const data = `songId=${id}`;
                    xhr.send(data);
                }
            });

        }

        // song array list
        const listOfData = [];
        // pushes the data from database into the array in a JSON format
        function fetchDataFromServer() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetchData.php', true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        const dataList = response.data;

                        // Loop through the retrieved data and format it into the desired structure
                        dataList.forEach(data => {
                            const formattedData = {
                                image: data.track_image,
                                name: data.track_name,
                                artist: data.track_artist,
                                length: data.track_duration,
                                album: data.track_album,
                                rating: data.rat_value, // Initial rating value
                                id: data.id
                            };
                            listOfData.push(formattedData);
                        });

                        // Call the function to create HTML using the retrieved and formatted data
                        createHTMLFromData();
                    } else {
                        console.error("Data retrieval failed:", response.message);
                    }
                }
            };

            xhr.send();
        }

        // Call the function to fetch data from the server
        fetchDataFromServer();

        // Function to create HTML using the retrieved and formatted data
        function createHTMLFromData() {
            function millisecondsToMinutes(milliseconds) {
                const totalSeconds = Math.floor(milliseconds / 1000);
                const minutes = Math.floor(totalSeconds / 60);
                const seconds = totalSeconds % 60;
                return `${minutes}:${String(seconds).padStart(2, '0')}`;
            }
            if (listOfData) {
                listOfData.map(data => {

                    const id = data.id;
                    const trackName = data.name;

                    const html = `
            <div class="songDetails">
                <div class="songJacket clearfix"><img src="${data.image}" alt="Song Image" style="width:100%"></div>
                <ul class="songInfo">
                    <li>
                        <p class="songName">${data.name}</p>
                    </li>
                    <li>
                        <p class="songArtist">${data.artist}</p>
                    </li>
                    <li>
                        <p class="songLength">${millisecondsToMinutes(data.length)}</p>
                    </li>
                    <li>
                        <p class="songGenre">${data.album}</p>
                    </li>
                    <li>
                        <p class="songRating">${data.rating}/10</p>
                    </li>
                    <li><button class="ratingButton" id="openModalButton${id}">Rate</button></li>
                    <a href="#" class="deleteButton" id="deleteButton${id}">Delete</a>
                    <div class="modal" id="ratingModal${id}">
                        <div class="modal-content">
                            <span class="close" id="closeModalButton${id}">&times;</span>
                            <h2>Rate This Song</h2>
                            <p>Rating:</p>
                            <select title="${id}select" id="ratingDropdown${id}" style="display: block">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <button type="button" id="submitRatingButton${id}">Submit</button>
                        </div>
                    </div>
                </ul>
            </div>
            `;

                    document.querySelector("#songList").insertAdjacentHTML('beforeend', html);

                    addFunctionsToComponent(id, trackName);
                });
            }
        }


        const APIController = (function () {
            // the spotify client ID and client Secret
            const clientId = 'e1a038cd324146dcb8e128abbf5b1e26';
            const clientSecret = 'd4a5e28c5a0c49f890ebb6062fb3b570';
            // gets the API token
            const _getToken = async () => {

                const result = await fetch('https://accounts.spotify.com/api/token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Authorization': 'Basic ' + btoa(clientId + ':' + clientSecret)
                    },
                    body: 'grant_type=client_credentials'
                });

                const data = await result.json();
                return data.access_token;
            }
            // fetches the search API from Spotify
            const _searchItem = async (token, query) => {
                const limit = 6;
                const result = await fetch(`https://api.spotify.com/v1/search?q=${query.replace(" ", "%20")}&type=artist,track&limit=${limit}`, {
                    method: 'GET',
                    headers: { 'Authorization': 'Bearer ' + token }
                });

                const data = await result.json();

                return data;
            }

            const _getSeveralAlbum = async (token) => {
                const result = await fetch('https://api.spotify.com/v1/albums?ids=382ObEPsp2rxGrnsizN5TX%2C1A2GTWGtFfWp7KSQTwWOyo%2C2noRn2Aes5aoNVsU6iWThc', {
                    method: 'GET',
                    headers: { 'Authorization': 'Bearer ' + token }
                });

                const data = await result.json();
                return data;
            }

            const _getSeveralArtist = async (token) => {
                const result = await fetch('https://api.spotify.com/v1/artists?ids=2CIMQHirSU0MQqyYHq0eOx%2C57dN52uHvrHOxijzpIgu3E', {
                    method: 'GET',
                    headers: { 'Authorization': 'Bearer ' + token }
                });

                const data = await result.json();
                return data;
            }

            const _getSeveralTrack = async (token) => {
                const result = await fetch('https://api.spotify.com/v1/tracks?ids=7ouMYWpwJ422jRcDASZB7P%2C4VqPOruhp5EdPBeR92t6lQ', {
                    method: 'GET',
                    headers: { 'Authorization': 'Bearer ' + token }
                });

                const data = await result.json();
                return data;
            }

            return {
                getToken() {
                    return _getToken();
                },
                searchItem(token, query) {
                    return _searchItem(token, query);
                },
                getSeveralAlbum(token) {
                    return _getSeveralAlbum(token);
                },
                getSeveralArtist(token) {
                    return _getSeveralArtist(token);
                },
                getSeveralTrack(token) {
                    return _getSeveralTrack(token);
                }
            }

        })();

        // UI Module
        const UIController = (function () {

            //object to hold references to html selectors
            const DOMElements = {
                search: '#search',
                searchButton: '#submit-search',
                hfToken: '#hidden_token',
                artistSection: '#artist-section',
                songSection: '#song-section',
                searchForm: "#search-bar-form",
                box2: '#box2',
                box5: '#box5',
                box6: '#box6',
                box3: '#box3',
                box1: '#box1',
                box7: '#box7',
                box8: '#box8',
                box4: '#box4',
                box9: '#box9',
                box10: '#box10'
            }

            //public methods
            return {

                //method to get input fields
                inputField() {
                    return {
                        searchBar: document.querySelector(DOMElements.search),
                        searchButton: document.querySelector(DOMElements.searchButton),
                        searchBarForm: document.querySelector(DOMElements.searchForm)
                    }
                },
                // need method to create the song detail
                createSongSection(imageURL, trackName, artistName, duration, albumName, id, SpotifyURL) {
                    // convert the miliseconds of the song to minutes
                    function millisecondsToMinutes(milliseconds) {
                        const totalSeconds = Math.floor(milliseconds / 1000);
                        const minutes = Math.floor(totalSeconds / 60);
                        const seconds = totalSeconds % 60;
                        return `${minutes}:${String(seconds).padStart(2, '0')}`;
                    }
                    // html element to create song and artist details
                    const html = `
            <div class="col l3 offset-l2 indigo lighten-1 albumcover" style="height: 300px; overflow: auto;">
            <a href="${SpotifyURL}">
  <img id="albumimage1" src="${imageURL}">
</a>                <p>
                    Track Name : ${trackName}
                </p>
                <p>
                    Artist : ${artistName}
                </p>
                <p>
                    Duration : ${millisecondsToMinutes(duration)}
                </p>
                <p>
                    Album Name : ${albumName}
                </p>
                <button class ="custom-button" type="button" id="addButton${id}">Add</button> 
            </div> 
            `;
                    document.querySelector(DOMElements.songSection).insertAdjacentHTML('beforeend', html);

                    const addButton = document.getElementById(`addButton${id}`);

                    addButton.addEventListener('click', () => {
                        var image_URL = `${imageURL}`;
                        var track_Name = `${trackName}`;
                        var trackArtist = `${artistName}`;
                        var trackDuration = `${duration}`;
                        var trackAlbum = `${albumName}`;


                        const duplicateCheckXhr = new XMLHttpRequest();
                        duplicateCheckXhr.open('GET', `duplicatesong.php?trackName=${encodeURIComponent(trackName)}`, true);

                        duplicateCheckXhr.onreadystatechange = function () {
                            if (duplicateCheckXhr.readyState === 4 && duplicateCheckXhr.status === 200) {
                                const response = duplicateCheckXhr.responseText;

                                if (response === "duplicate") {
                                    alert("Song with the same name already exists.");
                                } else {
                                    // Song is not a duplicate, proceed with adding
                                    alert(`You have added song ${trackName}`);

                                    const xhr = new XMLHttpRequest();
                                    xhr.open('POST', 'insertSong.php', true);
                                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                                    xhr.onreadystatechange = function () {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                            console.log(xhr.responseText);
                                        }
                                    };

                                    const data = `imageURL=${encodeURIComponent(imageURL)}&trackName=${encodeURIComponent(trackName)}&artistName=${encodeURIComponent(artistName)}&duration=${encodeURIComponent(duration)}&albumName=${encodeURIComponent(albumName)}`;
                                    xhr.send(data);
                                }
                            }
                        };

                        duplicateCheckXhr.send();
                    });
                },

                createArtistSection(imageURL, genres, artistName, followers, id, SpotifyURL) {

                    const html = `
            <div class="col l3 offset-l2 indigo lighten-1 albumcover" style="height: 300px; overflow: auto;">
            <a href="${SpotifyURL}">
  <img id="albumimage1" src="${imageURL}">
</a>                <p>
                    Artist Name : ${artistName}
                </p>
                <p>
                    Genre : ${genres}
                </p>
                <p>
                    Followers : ${followers}
                </p>
                <button class="custom-button favorite-button" type="button" id="favoriteButton${id}">☆</button>
            </div> 
            `;

                    document.querySelector(DOMElements.artistSection).insertAdjacentHTML('beforeend', html);

                    const favoriteButton = document.getElementById(`favoriteButton${id}`);

                    favoriteButton.addEventListener('click', () => {
                        var artist_name = `${artistName}`;
                        var artist_genre = `${genres}`;

                        const duplicateCheckXhr = new XMLHttpRequest();
                        duplicateCheckXhr.open('GET', `duplicateArtist.php?artistName=${encodeURIComponent(artistName)}`, true);

                        duplicateCheckXhr.onreadystatechange = function () {
                            if (duplicateCheckXhr.readyState === 4 && duplicateCheckXhr.status === 200) {
                                const response = duplicateCheckXhr.responseText;

                                if (response === "duplicate") {
                                    alert("Artist with the same name already exists.");
                                } else {
                                    // Artist is not a duplicate, proceed with adding
                                    alert(`You have added artist ${artistName}`);

                                    // Send artist data to the server
                                    sendArtistData(artist_name, artist_genre);
                                }
                            }
                        };

                        duplicateCheckXhr.send();
                    });

                    function sendArtistData(artistName, genres) {
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', 'insertArtist.php', true);
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                console.log(xhr.responseText);
                            }
                        };

                        const data = `artistName=${encodeURIComponent(artistName)}&genres=${encodeURIComponent(genres)}`;
                        xhr.send(data);
                    }
                },




                albumSection1(imageURL, albumName, releaseDate, artistName, imageLink) {
                    const html = `
            <a href=${imageLink}>
                <img id="image1" src=${imageURL} style="width: 225px; height: auto; float: left; margin-top: 17px">
            </a>
                <div class="paragraph" style="text-align: left; margin-left: 17px">
                <p>
                    Album Name: ${albumName}
                </p>
                <p>
                    Release Date: ${releaseDate}
                </p>
                <p>
                    Artist Name: ${artistName}
                </p>
                </div>
            `;

                    document.querySelector(DOMElements.box2).insertAdjacentHTML('beforeend', html);

                },

                trackSection1(imageURL) {
                    const html = `
            <div class="box5 column" style="background-image: url(${imageURL});">
            `;
                },
                // resets the song section 
                resetSongSection() {
                    const detailDiv = document.querySelector(DOMElements.songSection);
                    detailDiv.innerHTML = '';
                },
                // resets the artist section
                resetArtistSection() {
                    const detailDiv = document.querySelector(DOMElements.artistSection);
                    detailDiv.innerHTML = '';
                },
                // stores the API token
                storeToken(value) {
                    document.querySelector(DOMElements.hfToken).value = value;
                },

                getStoredToken() {
                    return {
                        token: document.querySelector(DOMElements.hfToken).value
                    }
                }
            }

        })();


        const APPController = (function (UICtrl, APICtrl) {
            const DOMInputs = UICtrl.inputField();
            // loads the token from the DOM
            const loadTokens = async () => {
                const token = await APICtrl.getToken();
                UICtrl.storeToken(token);
            }

            const loadAlbum = async () => {
                const token = UICtrl.getStoredToken().token;
                const album = await APICtrl.getSeveralAlbum(token);
                const albums = album.albums;
                return albums;
            }

            const loadArtist = async () => {
                const token = UICtrl.getStoredToken().token;
                const artist = await APICtrl.getSeveralArtist(token);
                const artists = artist.artists;

                return artists;
            }

            const loadTrack = async () => {
                const token = UICtrl.getStoredToken().token;
                const track = await APICtrl.getSeveralTrack(token);
                const tracks = track.tracks;

                return tracks;
            }


            DOMInputs.searchBarForm.addEventListener('submit', async (e) => {
                // prevent page reset
                e.preventDefault();
                // clear tracks
                UICtrl.resetArtistSection();
                UICtrl.resetSongSection();
                // get the search bar value
                const search = DOMInputs.searchBar.value;

                //get the token
                const token = UICtrl.getStoredToken().token;

                const results = await APICtrl.searchItem(token, search);
                // gets the artist information
                const artists = results.artists.items;
                console.log(artists);
                // gets the song information
                const tracks = results.tracks.items;

                artists.forEach(artist => {
                    UICtrl.createArtistSection(
                        artist.images.length == 0 ? "N/A" : artist.images[0].url,
                        artist.genres.length == 0 ? "N/A" : artist.genres.join(", "),
                        artist.name,
                        artist.followers.total,
                        artist.id,
                        artist.external_urls.spotify
                    )
                })

                tracks.forEach(track => {

                    var artistString = "";

                    track.artists.map((artist, index) => {
                        if (index == 0) {
                            artistString = artist.name
                        } else if (index == track.artists.length - 1) {
                            artistString = artistString + ", and " + artist.name
                        } else {
                            artistString = artistString + ", " + artist.name
                        }

                    })

                    UICtrl.createSongSection(
                        track.album.images.length == 0 ? "N/A" : track.album.images[0].url,
                        track.name,
                        artistString,
                        track.duration_ms,
                        track.album.name,
                        track.id,
                        track.external_urls.spotify
                    )
                })



            });

            return {
                async init() {
                    await loadTokens();
                    const getAlbum = await loadAlbum();
                    UICtrl.albumSection1(
                        getAlbum[0].images[0].url,
                        getAlbum[0].name,
                        getAlbum[0].release_date,
                        getAlbum[0].artists[0].name,
                        getAlbum[0].external_urls.spotify
                    )
                    const getArtist = await loadArtist();
                    const getTrack = await loadTrack();
                }
            }

        })(UIController, APIController);


        APPController.init();



    </script>
</body>

</html>