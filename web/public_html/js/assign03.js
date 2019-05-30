function getId(id) {
   return document.getElementById(id);
}

function getCls(cls) { // Isn't working right now.
   return document.getElementByClassName(cls);
}

function popCenter(id) {
   if (getId(id).classList.contains("thumbnail")) {
      getId(id).classList.add("thumbnailFocus");
      getId(id).classList.remove("thumbnail");
   } else if (getId(id).classList.contains("thumbnailFocus")) {
      getId(id).classList.add("thumbnail");
      getId(id).classList.remove("thumbnailFocus");
   }
}