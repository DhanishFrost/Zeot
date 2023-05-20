import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Admin create user
window.submitCreateUserForm = function () {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    
    if (name.trim() === '') {
        alert('Please enter a name.');
        return;
    }
    
    if (!isValidEmail(email)) {
        alert('Please enter a valid email address.');
        return;
    }
    
    if (password.length < 8) {
        alert('Password should be at least 8 characters long.');
        return;
    }
    
    fetch('/admin/users', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            name: name,
            email: email,
            password: password
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        var popupContent = document.querySelector('.popup-content');
        if (popupContent) {
            var xData = popupContent.querySelector('[x-data]');
            if (xData && xData.__x) {
                xData.__x.$data.openCreateUserPopup = false;
            }
        }
        location.reload();
    })
    .catch(error => {
        console.error(error);
    });
}

// Admin edit user
window.updateEditUserPopup = function(userId) {
    var editUserName = document.getElementById('editUserName-' + userId).value;
    var editUserEmail = document.getElementById('editUserEmail-' + userId).value;
    console.log(editUserName)
    console.log(editUserEmail)

    
    fetch('/admin/update-user', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            id: userId,
            editUserName: editUserName,
            editUserEmail: editUserEmail,
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(response.statusText);
        }
        return response.json();
    })    
    .then(data => {
        console.log('User updated successfully:', data);
        var popupContent = document.querySelector('.popup-content');
        if (popupContent) {
            var xData = popupContent.querySelector('[x-data]');
            if (xData && xData.__x) {
                xData.__x.$data.openEditUserPopup = false;
            }
        }
        location.reload();
    })
    .catch(error => {
        console.error(error);
    });
};



function isValidEmail(email) {
    var emailvalidation = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailvalidation.test(email);
}

// Admin Create Product
window.submitCreateProductForm = function () {
    var name = document.getElementById('name').value;
    var description = document.getElementById('description').value;
    var price = document.getElementById('price').value;
    var image = document.getElementById('image').files[0];
    
    if (name.trim() === '') {
        alert('Please enter a name.');
        return;
    }
    
    if (description.trim() === '') {
        alert('Please enter a description.');
        return;
    }
    
    if (price.trim() === '') {
        alert('Please enter a price.');
        return;
    }

    var formData = new FormData();
    formData.append('name', name);
    formData.append('description', description);
    formData.append('price', price);
    formData.append('image',  image);

    var reader = new FileReader(); 
        reader.onload = function(event) {
            var imagePreview = document.getElementById('image-preview');
            imagePreview.src = event.target.result; 
        };
        reader.readAsDataURL(image);
    
    fetch('/admin/adminproduct', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    
    .then(response => response.json())
    .then(data => {
        console.log(data);
        var popupContent = document.querySelector('.popup-content');
        if (popupContent) {
            var xData = popupContent.querySelector('[x-data]');
            if (xData && xData.__x) {
                xData.__x.$data.openCreateUserPopup = false;
            }
        }
        location.reload();
    })
    .catch(error => {
        console.error(error);
    });
}

// Admin edit product
window.updateEditProductPopup = function(productId) {
    var editProductName = document.getElementById('editProductName-' + productId).value;
    var editProductDescription = document.getElementById('editProductDescription-' + productId).value;
    var editProductPrice = document.getElementById('editProductPrice-' + productId).value;
    var editProductImage = document.getElementById('editProductImage-' + productId).files[0];

    var formData = new FormData();
    formData.append('id', productId);
    formData.append('editProductName', editProductName);
    formData.append('editProductDescription', editProductDescription);
    formData.append('editProductPrice', editProductPrice);
    formData.append('editProductImage', editProductImage);

    
    fetch('/admin/adminproduct-update', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData

    })
    .then(response => {
        if (!response.ok) {
            throw new Error(response.statusText);
        }
        return response.json();
    })    
    .then(data => {
        console.log('Product updated successfully:', data);
        var popupContent = document.querySelector('.popup-content');
        if (popupContent) {
            var xData = popupContent.querySelector('[x-data]');
            if (xData && xData.__x) {
                xData.__x.$data.openEditUserPopup = false;
            }
        }
        location.reload();
    })
    .catch(error => {
        console.error(error);
    });
}