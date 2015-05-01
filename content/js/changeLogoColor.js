var colors = ['red', 'blue', 'lightblue', 'green', 'yellow', "default"];

function changeColor(){
    var img = $('.welcome-page-wrapper>img');

    var rand = Math.floor((Math.random() * colors.length) + 0);
    img.attr("src", "/content/images/" + colors[rand] + "_cam.svg");
    img.css("cursor", "pointer");
}