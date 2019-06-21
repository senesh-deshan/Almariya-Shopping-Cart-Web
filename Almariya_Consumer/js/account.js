
function previewImages() {
	var imageFileChooserFiles = document.getElementById('file').files;
	var imagePreview = document.getElementById('profile');



		var imageFile = imageFileChooserFiles[0];

	preview(imageFile,imagePreview);


}

function preview(imageFile,imagePreview) {
	var reader = new FileReader();
	reader.onload = function() {
		imagePreview.src = reader.result;
	};

	reader.readAsDataURL(imageFile);
}


