document.querySelectorAll(".drop-zone__input").forEach(inputElement =>  {
  const dropZoneElement = inputElement.closest(".drop-zone");

  dropZoneElement.addEventListener("click", e => {
      inputElement.click();
  });

  inputElement.addEventListener("change", e => {
      if (inputElement.files.length){
          updateThumbnail(dropZoneElement, inputElement.files[0]);
      }
  });

  dropZoneElement.addEventListener("dragover", e => {
      e.preventDefault();
      dropZoneElement.classList.add("drop-zone--over");
  });

  ['dragleave', 'dragend'].forEach(type => {
      dropZoneElement.addEventListener(type, e => {
          dropZoneElement.classList.remove("drop-zone--over");
      });
  });

  dropZoneElement.addEventListener("drop", e => {
      e.preventDefault();
      // console.log(e.dataTransfer.files);
      if(e.dataTransfer.files.length) {
          inputElement.files = e.dataTransfer.files;
          // console.log(inputElement.files);
          updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
      }

      dropZoneElement.classList.remove("drop-zone--over");
  });
});

/**
* update the thumbnail on a drop element
* 
* 
* @param{HTMLElement} dropZoneElement
* @param {File} file
*/

function updateThumbnail(dropZoneElement, file){
  // console.log(dropZoneElement);
  console.log(file);
  let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

  //First time - remove the prompt
  if (dropZoneElement.querySelector(".drop-zone__prompt")){
      dropZoneElement.querySelector(".drop-zone__prompt").remove();
  }

  //first time - there is no thumbnail element
  if (!thumbnailElement){
      thumbnailElement = document.createElement("div");
      thumbnailElement.classList.add("drop-zone__thumb");
      dropZoneElement.appendChild(thumbnailElement);
  }

  thumbnailElement.dataset.label = file.name;

  //show thumbnail for image files
  if (file.type.startsWith("image/")) {
      const reader = new FileReader();

      reader.readAsDataURL(file);
      reader.onload = () => {
          thumbnailElement.style.backgroundImage = `url('${ reader.result }')`;
      }
  }else {
      thumbnailElement.style.backgroundImage = null;
  }
}
