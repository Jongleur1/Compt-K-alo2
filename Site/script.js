// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
} 

// MODIF PARAMETRE //

let btnModifParam = document.querySelector(".modif_param");
let btnValidParam = document.querySelector(".btn_valid_param");
let changeParam = document.querySelector(".change_param");


btnModifParam.addEventListener('click', () => {
  changeParam.style.display = "flex";
  changeParam.style.justifyContent = "center";
  btnModifParam.style.display = "none";
})

btnValidParam.addEventListener("click", () =>{
  changeParam.style.display = "none";
  btnModifParam.style.display = "flex";
  btnModifParam.style.justifyContent = "center";
})



