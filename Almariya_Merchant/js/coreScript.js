/*

var merchantImage = document.getElementById("merchantImage");
var hdName = document.getElementById("hdName");
var hdEmail = document.getElementById("hdEmail");
var hdID = document.getElementById("hdID");
var hdIns = document.getElementById("hdIns");
var formProductIdentifier = document.getElementById("formProductIdentifier");
var formProductCategory = document.getElementById("formProductCategory");
var formProductMaterial = document.getElementById("formProductMaterial");
var formProductPrice = document.getElementById("formProductPrice");
var formProductType = document.getElementById("formProductType");
var formProductSize = document.getElementById("formProductSize");
var formProductColour1 = document.getElementById("formProductColour1");
var formProductColour2 = document.getElementById("formProductColour2");
var formProductColour3 = document.getElementById("formProductColour3");
var formProductColour4 = document.getElementById("formProductColour4");
var buttonAdd = document.getElementById("btnAdd");
var buttonSave = document.getElementById("btnSave");
var productSizes = [];
var fullID = document.getElementById("fullID");
var fullID_OLD = document.getElementById("fullID_OLD");
var fullID_NEW = document.getElementById("fullID_NEW");

var divEditor = document.getElementById("divEditor");

var preview1 = document.getElementById('formProductImage1');
var preview2 = document.getElementById('formProductImage2');
var preview3 = document.getElementById('formProductImage3');
var preview4 = document.getElementById('formProductImage4');
var fileChooser1 = document.getElementById('formProductImageFile1');
var fileChooser2 = document.getElementById('formProductImageFile2');
var fileChooser3 = document.getElementById('formProductImageFile3');
var fileChooser4 = document.getElementById('formProductImageFile4');
var file1 = fileChooser1.files[0];
var file2 = fileChooser2.files[0];
var file3 = fileChooser3.files[0];
var file4 = fileChooser4.files[0];
var reader1 = new FileReader();
var reader2 = new FileReader();
var reader3 = new FileReader();
var reader4 = new FileReader();

var ulProductsList = document.getElementById("ulProductsList");

var databaseRef = firebase.database().ref("Database");
var storageRef = firebase.storage().ref("Products");
var authRef = firebase.auth();

var userID = "";

var samplePhotoURL = "https://firebasestorage.googleapis.com/v0/b/almariyatestserver.appspot.com/o/System%2FSAMPLE_PHOTO.jpg?alt=media&token=fbba14b9-8448-4e2c-96a5-20e82f3566ee";

var editorMode = false;

resetEditor();

authRef.onAuthStateChanged(function (user) {

if (user) {
userID = user.uid;
getProductsList(user.uid);

hdID.innerText = "Merchant ID - " + user.uid;
hdEmail.innerText = "Email - " + user.email;

databaseRef.child("Merchants").child(user.uid).once("value", function (datasnapshot) {
hdName.innerText = datasnapshot.val().name;
merchantImage.src = datasnapshot.val().imageURL;
});

databaseRef.child("System Details").child("Categories").once("value", function (datasnapshot) {
datasnapshot.forEach(function (childSnapshot) {
var option = document.createElement("option");
option.text = childSnapshot.key;
formProductCategory.appendChild(option);

})

databaseRef.child("System Details").child("Types").child(formProductCategory.options[formProductCategory.selectedIndex].text).once("value", function (datasnapshot) {
datasnapshot.forEach(function (childSnapshot) {
var option = document.createElement("option");
option.text = childSnapshot.key;
formProductType.appendChild(option);
})
});
});

databaseRef.child("System Details").child("Materials").once("value", function (datasnapshot) {
datasnapshot.forEach(function (childSnapshot) {
var option = document.createElement("option");
option.text = childSnapshot.key;
formProductMaterial.appendChild(option);

})
});

databaseRef.child("System Details").child("Sizes").once("value", function (datasnapshot) {
datasnapshot.forEach(function (childSnapshot) {
var chkbx = document.createElement("input");
var lbl = document.createElement("label");
chkbx.type = "checkbox";
chkbx.name = childSnapshot.val();
chkbx.value = childSnapshot.val();
chkbx.id = childSnapshot.val();

lbl.for = childSnapshot.val();
lbl.innerText = childSnapshot.val();
lbl.appendChild(chkbx);
formProductSize.appendChild(lbl);
productSizes.push(childSnapshot.val());
})
});

databaseRef.child("System Details").child("Colours").once("value", function (datasnapshot) {
var option = document.createElement("option");
option.text = "None";
formProductColour1.appendChild(option);
var option = document.createElement("option");
option.text = "None";
formProductColour2.appendChild(option);
var option = document.createElement("option");
option.text = "None";
formProductColour3.appendChild(option);
var option = document.createElement("option");
option.text = "None";
formProductColour4.appendChild(option);

datasnapshot.forEach(function (childSnapshot) {
var option = document.createElement("option");
option.text = childSnapshot.key;
formProductColour1.appendChild(option);
var option = document.createElement("option");
option.text = childSnapshot.key;
formProductColour2.appendChild(option);
var option = document.createElement("option");
option.text = childSnapshot.key;
formProductColour3.appendChild(option);
var option = document.createElement("option");
option.text = childSnapshot.key;
formProductColour4.appendChild(option);

})
});

} else {
window.open("Login.html", "_self", "", true);
}
});

formProductCategory.addEventListener("change", function () {
formProductType.innerHTML = "";
databaseRef.child("System Details").child("Types").child(formProductCategory.options[formProductCategory.selectedIndex].value).once("value", function (datasnapshot) {
datasnapshot.forEach(function (childSnapshot) {
var option = document.createElement("option");
option.text = childSnapshot.key;
formProductType.appendChild(option);
});
generateFullID();
});
});

formProductType.addEventListener("change", function () {
generateFullID();

});

formProductIdentifier.addEventListener("keyup", function () {
generateFullID();

});

formProductColour1.addEventListener("change", function () {
if (formProductColour1.options[formProductColour1.selectedIndex].text == "None") {
fileChooser1.disabled = true;
fileChooser1.value = "";
preview1.src = samplePhotoURL;
} else {
fileChooser1.disabled = false;
previewFile1();
}
});
formProductColour2.addEventListener("change", function () {
if (formProductColour2.options[formProductColour2.selectedIndex].text == "None") {
fileChooser2.disabled = true;
fileChooser2.value = "";
preview2.src = samplePhotoURL;
} else {
fileChooser2.disabled = false;
previewFile2();
}
});
formProductColour3.addEventListener("change", function () {
if (formProductColour3.options[formProductColour3.selectedIndex].text == "None") {
fileChooser3.disabled = true;
fileChooser3.value = "";
preview3.src = samplePhotoURL;
} else {
fileChooser3.disabled = false;
previewFile3();
}
});
formProductColour4.addEventListener("change", function () {
if (formProductColour4.options[formProductColour4.selectedIndex].text == "None") {
fileChooser4.disabled = true;
fileChooser4.value = "";
preview4.src = samplePhotoURL;
} else {
fileChooser4.disabled = false;
previewFile4();
}
});

function btnAdd() {
var PID = formProductIdentifier.value;
var Price = formProductPrice.value;
var Category = formProductCategory.options[formProductCategory.selectedIndex].text;
var Type = formProductType.options[formProductType.selectedIndex].text;
var Material = formProductMaterial.options[formProductMaterial.selectedIndex].text;
var Colour1 = formProductColour1.options[formProductColour1.selectedIndex].text;
var Colour2 = formProductColour2.options[formProductColour2.selectedIndex].text;
var Colour3 = formProductColour3.options[formProductColour3.selectedIndex].text;
var Colour4 = formProductColour4.options[formProductColour4.selectedIndex].text;
var sizes = [];

var productID_FULL;

if (file1 == null) {
Colour1 = "None"
}
if (file2 == null) {
Colour2 = "None"
}
if (file3 == null) {
Colour3 = "None"
}
if (file4 == null) {
Colour4 = "None"
}

Array.from(productSizes).forEach(function (sizeChkbxID) {
if (document.getElementById(sizeChkbxID).checked) {
sizes.push(sizeChkbxID);
}
});

if (file1 == null && file2 == null && file3 == null && file4 == null) {
window.alert("Please upload a product image");
} else {
if (PID == "" || Price == "" || Material == "" || Category == "" || Type == "" || sizes.length == 0) {
window.alert("Please complete the product details");
} else {
productID_FULL = userID + "_" + PID + "_" + Type + "_" + Category;

if (file1 != null && Colour1 != "None") {

var uploadTask1 = storageRef.child(productID_FULL + "_image1").put(file1);
uploadTask1.on("state_changed", function (snapshot) {
var percent = snapshot.bytesTransferred / snapshot.totalBytes * 100;
setProgress1(percent);
}, function (error) {
window.alert(error.message);

}, function () {
uploadTask1.snapshot.ref.getDownloadURL().then(function (downloadURL) {

databaseRef.child("Products").child(productID_FULL).child("imageURL").update({
image1: downloadURL
});
});
setProgress1(0);
});

} else {
storageRef.child(productID_FULL + "_image1").delete().then(function () {
}).catch(function (error) {
});
databaseRef.child("Products").child(productID_FULL).child("imageURL").update({
image1: "None"
});
}
if (file2 != null && Colour2 != "None") {

var uploadTask2 = storageRef.child(productID_FULL + "_image2").put(file2);
uploadTask2.on("state_changed", function (snapshot) {
var percent = snapshot.bytesTransferred / snapshot.totalBytes * 100;
setProgress2(percent);
}, function (error) {
window.alert(error.message);

}, function () {
uploadTask2.snapshot.ref.getDownloadURL().then(function (downloadURL) {

databaseRef.child("Products").child(productID_FULL).child("imageURL").update({
image2: downloadURL
});
});
setProgress2(0);
});

} else {
storageRef.child(productID_FULL + "_image2").delete().then(function () {
}).catch(function (error) {
});
databaseRef.child("Products").child(productID_FULL).child("imageURL").update({
image2: "None"
});
}
if (file3 != null && Colour3 != "None") {

var uploadTask3 = storageRef.child(productID_FULL + "_image3").put(file3);
uploadTask3.on("state_changed", function (snapshot) {
var percent = snapshot.bytesTransferred / snapshot.totalBytes * 100;
setProgress3(percent);
}, function (error) {
window.alert(error.message);

}, function () {
uploadTask3.snapshot.ref.getDownloadURL().then(function (downloadURL) {

databaseRef.child("Products").child(productID_FULL).child("imageURL").update({
image3: downloadURL
});
});
setProgress3(0);
});

} else {
storageRef.child(productID_FULL + "_image3").delete().then(function () {
}).catch(function (error) {
});
databaseRef.child("Products").child(productID_FULL).child("imageURL").update({
image3: "None"
});
}
if (file4 != null && Colour4 != "None") {

var uploadTask4 = storageRef.child(productID_FULL + "_image4").put(file4);
uploadTask4.on("state_changed", function (snapshot) {
var percent = snapshot.bytesTransferred / snapshot.totalBytes * 100;
setProgress4(percent);
}, function (error) {
window.alert(error.message);

}, function () {
uploadTask4.snapshot.ref.getDownloadURL().then(function (downloadURL) {

databaseRef.child("Products").child(productID_FULL).child("imageURL").update({
image4: downloadURL
});
});
setProgress4(0);
});

} else {
storageRef.child(productID_FULL + "_image4").delete().then(function () {
}).catch(function (error) {
});
databaseRef.child("Products").child(productID_FULL).child("imageURL").update({
image4: "None"
});
}

databaseRef.child("Products").child(productID_FULL).set({
productID: PID,
merchantID: userID,
price: Price,
material: Material,
category: Category,
type: Type,
colour: {
colour1: Colour1,
colour2: Colour2,
colour3: Colour3,
colour4: Colour4
}
});

databaseRef.child("Products").child(productID_FULL).update({
sizes
});

if (document.getElementById("resetEnabled").checked) {
resetEditor();
}
refreshProductsList();
}
}

}

function btnSave() {
var PID = formProductIdentifier.value;
var Price = formProductPrice.value;
var Category = formProductCategory.options[formProductCategory.selectedIndex].text;
var Type = formProductType.options[formProductType.selectedIndex].text;
var Material = formProductMaterial.options[formProductMaterial.selectedIndex].text;
var Colour1 = formProductColour1.options[formProductColour1.selectedIndex].text;
var Colour2 = formProductColour2.options[formProductColour2.selectedIndex].text;
var Colour3 = formProductColour3.options[formProductColour3.selectedIndex].text;
var Colour4 = formProductColour4.options[formProductColour4.selectedIndex].text;
var image1 = preview1.src;
var image2 = preview2.src;
var image3 = preview3.src;
var image4 = preview4.src;
var sizes = [];

var productID_FULL_NEW = fullID_NEW.innerHTML;
var productID_FULL_OLD = fullID_OLD.innerHTML;

console.log(Colour1);
console.log(Colour2);
console.log(Colour3);
console.log(Colour4);
console.log(image1);
console.log(image2);
console.log(image3);
console.log(image4);
console.log(file1);
console.log(file2);
console.log(file3);
console.log(file4);

Array.from(productSizes).forEach(function (sizeChkbxID) {
if (document.getElementById(sizeChkbxID).checked) {
sizes.push(sizeChkbxID);
}
});

if (PID == "" || Price == "" || Material == "" || Category == "" || Type == "" || sizes.length == 0) {
window.alert("Please complete the product details");
} else {
productID_FULL = userID + "_" + PID + "_" + Type + "_" + Category;

if (file1 != null && Colour1 != "None") {
if (productID_FULL_OLD != productID_FULL_NEW) {
storageRef.child(productID_FULL_OLD + "_image1").delete().then(function () {
}).catch(function (error) {
});
databaseRef.child("Products").child(productID_FULL_OLD).child("imageURL").update({
image1: "None"
});
}

var uploadTask1 = storageRef.child(productID_FULL_NEW + "_image1").put(file1);
uploadTask1.on("state_changed", function (snapshot) {
var percent = snapshot.bytesTransferred / snapshot.totalBytes * 100;
setProgress1(percent);
}, function (error) {
window.alert(error.message);

}, function () {
uploadTask1.snapshot.ref.getDownloadURL().then(function (downloadURL) {

databaseRef.child("Products").child(productID_FULL_OLD).child("imageURL").update({
image1: downloadURL
});
});
setProgress1(0);
});

} else if (file1 == null && Colour1 == "None") {
storageRef.child(productID_FULL_OLD + "_image1").delete().then(function () {
}).catch(function (error) {
});
databaseRef.child("Products").child(productID_FULL_OLD).child("imageURL").update({
image1: "None"
});
} else {
databaseRef.child("Products").child(productID_FULL_NEW).child("imageURL").update({
image1: image1
});
}
if (file2 != null && Colour2 != "None") {
if (productID_FULL_OLD != productID_FULL_NEW) {
storageRef.child(productID_FULL_OLD + "_image2").delete().then(function () {
}).catch(function (error) {
});
databaseRef.child("Products").child(productID_FULL_OLD).child("imageURL").update({
image2: "None"
});
}
var uploadTask2 = storageRef.child(productID_FULL_NEW + "_image2").put(file2);
uploadTask2.on("state_changed", function (snapshot) {
var percent = snapshot.bytesTransferred / snapshot.totalBytes * 100;
setProgress2(percent);
}, function (error) {
window.alert(error.message);

}, function () {
uploadTask2.snapshot.ref.getDownloadURL().then(function (downloadURL) {

databaseRef.child("Products").child(productID_FULL_OLD).child("imageURL").update({
image2: downloadURL
});
});
setProgress2(0);
});

} else if (file2 == null && Colour2 == "None") {
storageRef.child(productID_FULL_OLD + "_image2").delete().then(function () {
}).catch(function (error) {
});
databaseRef.child("Products").child(productID_FULL_OLD).child("imageURL").update({
image2: "None"
});
} else {
databaseRef.child("Products").child(productID_FULL_NEW).child("imageURL").update({
image2: image2
});
}
if (file3 != null && Colour3 != "None") {
if (productID_FULL_OLD != productID_FULL_NEW) {
storageRef.child(productID_FULL_OLD + "_image3").delete().then(function () {
}).catch(function (error) {
});
databaseRef.child("Products").child(productID_FULL_OLD).child("imageURL").update({
image3: "None"
});
}
var uploadTask3 = storageRef.child(productID_FULL_NEW + "_image3").put(file3);
uploadTask3.on("state_changed", function (snapshot) {
var percent = snapshot.bytesTransferred / snapshot.totalBytes * 100;
setProgress3(percent);
}, function (error) {
window.alert(error.message);

}, function () {
uploadTask3.snapshot.ref.getDownloadURL().then(function (downloadURL) {

databaseRef.child("Products").child(productID_FULL_OLD).child("imageURL").update({
image3: downloadURL
});
});
setProgress3(0);
});

} else if (file3 == null && Colour3 == "None") {
storageRef.child(productID_FULL_OLD + "_image3").delete().then(function () {
}).catch(function (error) {
});
databaseRef.child("Products").child(productID_FULL_OLD).child("imageURL").update({
image3: "None"
});
} else {
databaseRef.child("Products").child(productID_FULL_NEW).child("imageURL").update({
image3: image3
});
}
if (file4 != null && Colour4 != "None") {
if (productID_FULL_OLD != productID_FULL_NEW) {
storageRef.child(productID_FULL_OLD + "_image4").delete().then(function () {
}).catch(function (error) {
});
databaseRef.child("Products").child(productID_FULL).child("imageURL").update({
image4: "None"
});
}
var uploadTask4 = storageRef.child(productID_FULL_NEW + "_image4").put(file4);
uploadTask4.on("state_changed", function (snapshot) {
var percent = snapshot.bytesTransferred / snapshot.totalBytes * 100;
setProgress4(percent);
}, function (error) {
window.alert(error.message);

}, function () {
uploadTask4.snapshot.ref.getDownloadURL().then(function (downloadURL) {

databaseRef.child("Products").child(productID_FULL_OLD).child("imageURL").update({
image4: downloadURL
});
});
setProgress4(0);
});

} else if (file4 == null && Colour4 == "None") {
storageRef.child(productID_FULL_OLD + "_image4").delete().then(function () {
}).catch(function (error) {
});
databaseRef.child("Products").child(productID_FULL).child("imageURL").update({
image4: "None"
});
} else {
databaseRef.child("Products").child(productID_FULL_NEW).child("imageURL").update({
image4: image4
});
}

if (productID_FULL_OLD != productID_FULL_NEW) {
console.log("HIT" + productID_FULL_OLD);
databaseRef.child("Products").child(productID_FULL_OLD).remove();
}

databaseRef.child("Products").child(productID_FULL_NEW).update({
productID: PID,
merchantID: userID,
price: Price,
material: Material,
category: Category,
type: Type,
colour: {
colour1: Colour1,
colour2: Colour2,
colour3: Colour3,
colour4: Colour4
}
});

databaseRef.child("Products").child(productID_FULL_NEW).update({
sizes
});

if (document.getElementById("resetEnabled").checked) {
resetEditor();
}
refreshProductsList();
}

}

function getProductsList(uID) {
userID = uID;
databaseRef.child("Products").orderByChild("merchantID").equalTo(userID).once("value", function (datasnapshot) {
datasnapshot.forEach(function (childSnapshot) {
addProductToList(childSnapshot);

// console.log(childSnapshot.key);
});
});
}

function addProductToList(product) {

var productID_FULL = product.key;
var productID = product.val().productID;
var merchantID = product.val().merchantID;
var price = product.val().price;
var material = product.val().material;
var category = product.val().category;
var type = product.val().type;
var sizes = product.val().sizes;
var colour1 = product.val().colour.colour1;
var colour2 = product.val().colour.colour2;
var colour3 = product.val().colour.colour3;
var colour4 = product.val().colour.colour4;
var image1 = product.val().imageURL.image1;
var image2 = product.val().imageURL.image2;
var image3 = product.val().imageURL.image3;
var image4 = product.val().imageURL.image4;

var liProductItem = document.createElement("li");
var tblProductTable = document.createElement("table");
var tblProductTableMainRow = document.createElement("tr");
var tblProductTableMainData = document.createElement("td");
var tblProductTableMainImages = document.createElement("td");
var tblProductTableData = document.createElement("table");
var tblProductTableImages = document.createElement("table");
var tblProductTableImagesRow = document.createElement("tr");
var tblProductTableImagesData1 = document.createElement("td");
var tblProductTableImagesData2 = document.createElement("td");
var tblProductTableImagesData3 = document.createElement("td");
var tblProductTableImagesData4 = document.createElement("td");

var productColor1 = document.createElement("span");
var productColor2 = document.createElement("span");
var productColor3 = document.createElement("span");
var productColor4 = document.createElement("span");
var imgProductImage1 = document.createElement("img");
var imgProductImage2 = document.createElement("img");
var imgProductImage3 = document.createElement("img");
var imgProductImage4 = document.createElement("img");

var ProductID_FULL = document.createElement("span");
var ProductID = document.createElement("span");
var ProductPrice = document.createElement("span");
var ProductMaterial = document.createElement("span");
var ProductCategory = document.createElement("span");
var ProductType = document.createElement("span");
var ProductSizes = document.createElement("span");

var btnRemove = document.createElement("button");
var btnEdit = document.createElement("button");

btnRemove.innerHTML = "Remove";
btnRemove.id = productID_FULL;
btnEdit.innerHTML = "Edit";

btnRemove.onclick = function () {

storageRef.child(productID_FULL + "_image1").delete().then(function () {
}).catch(function (error) {
});
storageRef.child(productID_FULL + "_image2").delete().then(function () {
}).catch(function (error) {
});
storageRef.child(productID_FULL + "_image3").delete().then(function () {
}).catch(function (error) {
});
storageRef.child(productID_FULL + "_image4").delete().then(function () {
}).catch(function (error) {
});

databaseRef.child("Products").child(productID_FULL).remove();

ulProductsList.removeChild(ulProductsList.querySelector("#" + this.id));

};

btnEdit.onclick = function () {
resetEditor();

fullID_NEW.innerHTML = productID_FULL;
fullID_OLD.innerHTML = productID_FULL;
formProductIdentifier.value = productID;
formProductCategory.value = category;
formProductType.innerHTML = "";
databaseRef.child("System Details").child("Types").child(formProductCategory.options[formProductCategory.selectedIndex].text).once("value", function (datasnapshot) {
datasnapshot.forEach(function (childSnapshot) {
var option = document.createElement("option");
option.text = childSnapshot.key;
formProductType.appendChild(option);
formProductType.value = type;
})
});

formProductMaterial.value = material;
formProductPrice.value = price;

formProductSize.innerHTML = "";
Array.from(productSizes).forEach(function (productSize) {

var chkbx = document.createElement("input");
var lbl = document.createElement("label");
chkbx.type = "checkbox";
chkbx.name = productSize;
chkbx.value = productSize;
chkbx.id = productSize;
chkbx.checked = sizes.indexOf(productSize) > -1;

lbl.for = productSize;
lbl.innerText = productSize;
lbl.appendChild(chkbx);
formProductSize.appendChild(lbl);

});

if (colour1 != "None") {
formProductColour1.value = colour1;
preview1.src = image1;
fileChooser1.disabled = false;
}
if (colour2 != "None") {
formProductColour2.value = colour2;
preview2.src = image2;
fileChooser2.disabled = false;
}
if (colour3 != "None") {
formProductColour3.value = colour3;
preview3.src = image3;
fileChooser3.disabled = false;
}
if (colour4 != "None") {
formProductColour4.value = colour4;
preview4.src = image4;
fileChooser4.disabled = false;
}

setEditor();
};

if (image1 != "None" && image1 != undefined) {
imgProductImage1.src = image1;
productColor1.innerHTML = colour1;
}
if (image2 != "None" && image2 != undefined) {
imgProductImage2.src = image2;
productColor2.innerHTML = colour2;
}
if (image3 != "None" && image3 != undefined) {
imgProductImage3.src = image3;
productColor3.innerHTML = colour3;
}
if (image4 != "None" && image4 != undefined) {
imgProductImage4.src = image4;
productColor4.innerHTML = colour4;
}

imgProductImage1.style.height = "100px";
imgProductImage2.style.height = "100px";
imgProductImage3.style.height = "100px";
imgProductImage4.style.height = "100px";

ProductID_FULL.innerHTML = productID_FULL;
ProductID.innerHTML = "ID: " + productID;
ProductCategory.innerHTML = "Category: " + category;
ProductType.innerHTML = "Type: " + type;
ProductMaterial.innerHTML = "Material: " + material;
ProductPrice.innerHTML = "Price: LKR " + price;

ProductSizes.innerHTML += "Sizes: | ";
Array.from(sizes).forEach(function (sizeItem) {
ProductSizes.innerHTML += sizeItem + " | ";
});

tblProductTableImagesData1.appendChild(productColor1);
tblProductTableImagesData1.appendChild(document.createElement("br"));
tblProductTableImagesData1.appendChild(imgProductImage1);
tblProductTableImagesData2.appendChild(productColor2);
tblProductTableImagesData2.appendChild(document.createElement("br"));
tblProductTableImagesData2.appendChild(imgProductImage2);
tblProductTableImagesData3.appendChild(productColor3);
tblProductTableImagesData3.appendChild(document.createElement("br"));
tblProductTableImagesData3.appendChild(imgProductImage3);
tblProductTableImagesData4.appendChild(productColor4);
tblProductTableImagesData4.appendChild(document.createElement("br"));
tblProductTableImagesData4.appendChild(imgProductImage4);

tblProductTableImagesRow.appendChild(tblProductTableImagesData1);
tblProductTableImagesRow.appendChild(tblProductTableImagesData2);
tblProductTableImagesRow.appendChild(tblProductTableImagesData3);
tblProductTableImagesRow.appendChild(tblProductTableImagesData4);
tblProductTableImages.appendChild(tblProductTableImagesRow);

liProductItem.appendChild(ProductID_FULL);
tblProductTableData.appendChild(ProductID);
tblProductTableData.appendChild(document.createElement("br"));
tblProductTableData.appendChild(ProductCategory);
tblProductTableData.appendChild(document.createElement("br"));
tblProductTableData.appendChild(ProductType);
tblProductTableData.appendChild(document.createElement("br"));
tblProductTableData.appendChild(ProductMaterial);
tblProductTableData.appendChild(document.createElement("br"));
tblProductTableData.appendChild(ProductSizes);
tblProductTableData.appendChild(document.createElement("br"));
tblProductTableData.appendChild(ProductPrice);
tblProductTableData.appendChild(document.createElement("br"));
tblProductTableData.appendChild(btnEdit);
tblProductTableData.appendChild(document.createElement("br"));
tblProductTableData.appendChild(btnRemove);
tblProductTableData.style.width = "200px";

tblProductTableMainData.appendChild(tblProductTableData);
tblProductTableMainImages.appendChild(tblProductTableImages);
tblProductTableMainRow.appendChild(tblProductTableMainData);
tblProductTableMainRow.appendChild(tblProductTableMainImages);
tblProductTable.appendChild(tblProductTableMainRow);

liProductItem.appendChild(tblProductTable);
liProductItem.style.marginBottom = "50px";
liProductItem.id = productID_FULL;
ulProductsList.appendChild(liProductItem);

}

function previewFile1() {

file1 = document.getElementById('formProductImageFile1').files[0]; //sames as here
reader1 = new FileReader();

reader1.onloadend = function () {
preview1.src = reader1.result;
}

if (file1) {
reader1.readAsDataURL(file1); //reads the data as a URL
} else {
preview1.src = samplePhotoURL;
}

//window.alert(document.getElementById('formProductImageFile').value);
}

function previewFile2() {

file2 = document.getElementById('formProductImageFile2').files[0]; //sames as here
reader2 = new FileReader();

reader2.onloadend = function () {
preview2.src = reader2.result;
}

if (file2) {
reader2.readAsDataURL(file2); //reads the data as a URL
} else {
preview2.src = samplePhotoURL;
}

//window.alert(document.getElementById('formProductImageFile').value);
}

function previewFile3() {

file3 = document.getElementById('formProductImageFile3').files[0]; //sames as here
reader3 = new FileReader();

reader3.onloadend = function () {
preview3.src = reader3.result;
}

if (file3) {
reader3.readAsDataURL(file3); //reads the data as a URL
} else {
preview3.src = samplePhotoURL;
}

//window.alert(document.getElementById('formProductImageFile').value);
}

function previewFile4() {

file4 = document.getElementById('formProductImageFile4').files[0]; //sames as here
reader4 = new FileReader();

reader4.onloadend = function () {
preview4.src = reader4.result;
}

if (file4) {
reader4.readAsDataURL(file4); //reads the data as a URL
} else {
preview4.src = samplePhotoURL;
}

//window.alert(document.getElementById('formProductImageFile').value);
}

function signOut() {
authRef.signOut();
}

function viewOrders() {

}

function resetEditor() {
editorMode = false;

formProductIdentifier.value = "";
formProductPrice.value = "";

document.getElementById('formProductImageFile1').value = "";
document.getElementById('formProductImageFile2').value = "";
document.getElementById('formProductImageFile3').value = "";
document.getElementById('formProductImageFile4').value = "";
preview1.src = samplePhotoURL;
preview2.src = samplePhotoURL;
preview3.src = samplePhotoURL;
preview4.src = samplePhotoURL;
fileChooser1.disabled = true;
fileChooser2.disabled = true;
fileChooser3.disabled = true;
fileChooser4.disabled = true;
file1 = null;
file2 = null;
file3 = null;
file4 = null;
formProductColour1.value = "None";
formProductColour2.value = "None";
formProductColour3.value = "None";
formProductColour4.value = "None";
buttonAdd.style.visibility = "visible";
buttonSave.style.visibility = "hidden";
document.getElementById('productFull_ID_Add').style.display = "block";
document.getElementById('productFull_ID_Edit').style.display = "none";
hdIns.innerHTML = "Add Product";
divEditor.style.border = "5px solid aqua";
divEditor.style.height = "500px";
setProgress1(0);
setProgress2(0);
setProgress3(0);
setProgress4(0);
}

function setEditor() {
editorMode = true;

document.getElementById('formProductImageFile1').value = "";
document.getElementById('formProductImageFile2').value = "";
document.getElementById('formProductImageFile3').value = "";
document.getElementById('formProductImageFile4').value = "";
buttonAdd.style.visibility = "hidden";
buttonSave.style.visibility = "visible";
document.getElementById('productFull_ID_Add').style.display = "none";
document.getElementById('productFull_ID_Edit').style.display = "block";
hdIns.innerHTML = "Edit Product";
divEditor.style.border = "5px solid yellow";
divEditor.style.height = "570px";
}

function refreshProductsList() {
ulProductsList.innerHTML = "";
//   setTimeout(getProductsList(authRef.currentUser.uid),0);
getProductsList(authRef.currentUser.uid);
}

setProgress1(0);

function setProgress1(val) {
var bar1 = document.getElementById("bar1");
var progress1 = document.getElementById("progress1");
bar1.style.width = val + '%';
if (bar1.style.width == "0%") {
progress1.style.visibility = "hidden";
} else {
progress1.style.visibility = "visible";
}
}

setProgress2(0);

function setProgress2(val) {
var bar2 = document.getElementById("bar2");
var progress2 = document.getElementById("progress2");
bar2.style.width = val + '%';
if (bar2.style.width == "0%") {
progress2.style.visibility = "hidden";
} else {
progress2.style.visibility = "visible";
}
}

setProgress3(0);

function setProgress3(val) {
var bar3 = document.getElementById("bar3");
var progress3 = document.getElementById("progress3");
bar3.style.width = val + '%';
if (bar3.style.width == "0%") {
progress3.style.visibility = "hidden";
} else {
progress3.style.visibility = "visible";
}
}

setProgress4(0);

function setProgress4(val) {
var bar4 = document.getElementById("bar4");
var progress4 = document.getElementById("progress4");
bar4.style.width = val + '%';
if (bar4.style.width == "0%") {
progress4.style.visibility = "hidden";
} else {
progress4.style.visibility = "visible";
}
}

function generateFullID() {
var PID = formProductIdentifier.value;
var Category = formProductCategory.options[formProductCategory.selectedIndex].value;
var Type = formProductType.options[formProductType.selectedIndex].value;

var productID_FULL = userID + "_" + PID + "_" + Type + "_" + Category;

if (editorMode) {
fullID_NEW.innerHTML = productID_FULL;
} else {
fullID.innerHTML = productID_FULL;
}
}

*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function previewImages() {
	var samplePhotoURL = "https://firebasestorage.googleapis.com/v0/b/almariyatestserver.appspot.com/o/System%2FSAMPLE_PHOTO.jpg?alt=media&token=fbba14b9-8448-4e2c-96a5-20e82f3566ee";
	var imageFileChooserFiles = document.getElementById('imageChooser').files;
	var imagePreviewTable = document.getElementById('imagesPreview');

var colorListMain = document.getElementById("color_list");

imagePreviewTable.innerHTML="";

var imageCount = imageFileChooserFiles.length;

	for (var i = 0; i < imageCount; i++) {

		var imageFile = imageFileChooserFiles[i];
		
//		alert(imageFile['tmp_name']);

		var imagePreview = document.createElement("img");
		var imagePreviewRow = document.createElement("tr");
		var imagePreviewDataImage = document.createElement("td");
		var imagePreviewDataConfig = document.createElement("td");
		var removeButton = document.createElement("button");
		
		var colorList = colorListMain.cloneNode(true);
		//colorList.name="colors[]";
		colorList.id = i;
		colorList.style.visibility = "visible";
		colorList.onchange=function updateColors () {
		
		var colors=new Array();
		for (var j = 0; j < imageCount; j++) {		
		  
		  colors[j]=document.getElementById(j).value;
	
		 }
		
		document.getElementById("colors").value=colors;	

		};

		imagePreview.className = "image-product";

		removeButton.innerText = "X";
		removeButton.onclick = function() {

		imagePreviewTable.removeChild(this.parentNode.parentNode);
		};
		
		preview(imageFile,imagePreview);

		imagePreviewTable.appendChild(imagePreviewRow);
		imagePreviewRow.appendChild(imagePreviewDataImage);
		imagePreviewRow.appendChild(imagePreviewDataConfig);
		imagePreviewDataImage.appendChild(imagePreview);
		imagePreviewDataConfig.appendChild(colorList);
		imagePreviewDataConfig.appendChild(removeButton);

	
	}

var colors=new Array();
		for (var j = 0; j < imageCount; j++) {		
		  
		  colors[j]=document.getElementById(j).value;
	
		 }
		
		document.getElementById("colors").value=colors;	


}

function preview(imageFile,imagePreview) {
	var reader = new FileReader();
	reader.onload = function() {
		imagePreview.src = reader.result;
	};

	reader.readAsDataURL(imageFile);
}


