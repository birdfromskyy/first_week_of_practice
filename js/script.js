let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   profile.classList.remove('active');
   navbar.classList.remove('active');
}

function showPastOrders() {
   document.getElementById('pastOrders').style.display = 'block';
 }
 
 
 document.addEventListener('DOMContentLoaded', function() {
   document.querySelectorAll('.past-order').forEach(item => {
     item.addEventListener('click', function() {
       const orderId = this.getAttribute('data-orderid');
       fetchOrderData(orderId);
     });
   });
 });
 
 function fetchOrderData(orderId) {
   fetch('fetch_order_data.php', {
     method: 'POST',
     headers: {
       'Content-Type': 'application/json',
     },
     body: JSON.stringify({ orderId: orderId })
   })
   .then(response => response.json())
   .then(data => {
     fillFormWithOrderData(data);
   })
   .catch((error) => {
     console.error('Error:', error);
   });
 }
 
 function fillFormWithOrderData(data) {
   document.querySelector('input[name="name"]').value = data.name;
   document.querySelector('input[name="number"]').value = data.number;
   document.querySelector('input[name="email"]').value = data.email;
   document.querySelector('select[name="method"]').value = data.method; // Предполагается, что у вас есть выпадающий список для выбора метода оплаты
   document.querySelector('input[name="flat"]').value = data.flat;
   document.querySelector('input[name="street"]').value = data.street;
   document.querySelector('input[name="city"]').value = data.city;
   document.querySelector('input[name="pin"]').value = data.pin;
}
 

