//Sticky naviagation bar
document.addEventListener("DOMContentLoaded", function(event) {
    var scrollpos = localStorage.getItem('scrollpos');
    if (scrollpos) window.scrollTo(0, scrollpos);
});

window.onbeforeunload = function(e) {
    localStorage.setItem('scrollpos', window.scrollY);
};

window.onscroll = function() {myFunction()};
var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;
function myFunction() {
if (window.pageYOffset >= sticky) {
navbar.classList.add("sticky")
} else {
navbar.classList.remove("sticky");
}
}

// Chatbot toggling
document.getElementById("toggleChatbot").addEventListener("click", () => {
    const chatbot = document.getElementById("chatbot");
    if (chatbot.style.display === "none") {
        chatbot.style.display = "block";
    } else {
        chatbot.style.display = "none";
    }
});

// Handling message sending
document.getElementById("sendButton").addEventListener("click", async () => {
    const userMessage = document.getElementById("userInput").value.trim();
    
    if (userMessage) {
        // Add user message to the chat window
        addMessage(userMessage, "user-message");

        // Clear the input
        document.getElementById("userInput").value = '';

        // Send the message to the backend
        try {
            const response = await fetch('http://localhost:5000/chatbot/predict', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ instruction: userMessage }),
            });

            const data = await response.json();
            const predictedIntent = data.intent || "unknown";
            const botMessage = getResponseForIntent(predictedIntent);

            // Add bot message to the chat window
            addMessage(botMessage, "bot-message");

        } catch (error) {
            console.error('Error:', error);
            addMessage("Sorry, something went wrong.", "bot-message");
        }
    }
});

function addMessage(message, className) {
    const messagesContainer = document.getElementById("chatbotMessages");
    const messageElement = document.createElement("div");
    messageElement.classList.add("chatbot-message", className);
    messageElement.textContent = message;
    messagesContainer.appendChild(messageElement);

    // Scroll to the bottom of the messages container
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

// Mapping intents to suitable responses
function getResponseForIntent(intent) {
    const responses = {
        'add_product': "You can add products by browsing our catalog and clicking on 'Add to Cart'.",
        'availability': "Let me check the availability of that product for you.",
        'availability_in_store': "The product is available at our physical stores. Would you like to visit the nearest one?",
        'availability_online': "The product is available online for purchase.",
        'cancel_order': "To cancel your order, please visit your order history and select the order you'd like to cancel.",
        'change_account': "You can change your account details in the account settings section.",
        'change_order': "You can modify your order in the order history section as long as it hasn't been shipped.",
        'close_account': "We're sorry to see you go. To close your account, visit the account settings.",
        'customer_service': "You can reach customer service through our support page or call our hotline at 1-800-123-4567.",
        'damaged_delivery': "We're sorry for the inconvenience. You can file a complaint and request a replacement for damaged products.",
        'delivery_issue': "If you're facing a delivery issue, please provide your order number, and we'll investigate it.",
        'delivery_time': "Estimated delivery times are shown during checkout. Do you need to check your current order?",
        'exchange_product': "To exchange a product, you can follow the return process and select 'Exchange'.",
        'exchange_product_in_store': "You can visit our nearest store to exchange your product.",
        'human_agent': "Let me transfer you to a human agent. Please wait a moment.",
        'missing_item': "If an item is missing from your delivery, please let us know, and we'll resolve it for you.",
        'open_account': "You can create a new account by signing up on our website.",
        'order_history': "You can view your order history in the account section under 'My Orders'.",
        'pay': "You can proceed to payment by going to your cart and selecting 'Checkout'.",
        'payment_issue': "If you're facing a payment issue, please try another payment method or contact support.",
        'payment_methods': "We accept credit cards, PayPal, and other payment methods. Would you like to know more?",
        'product_information': "Please provide the product name or code, and I will give you more details.",
        'product_issue': "If you're having a product issue, let us know the details, and we'll assist you.",
        'recover_password': "You can reset your password by clicking 'Forgot Password' on the login page.",
        'refund_policy': "Our refund policy allows returns within 30 days of purchase with proof of receipt.",
        'refund_status': "You can track the status of your refund in the 'My Orders' section.",
        'remove_product': "You can remove products from your cart by selecting 'Remove' next to the item.",
        'request_invoice': "You can request an invoice from the 'My Orders' section after placing your order.",
        'request_refund': "To request a refund, follow the return process in the 'My Orders' section.",
        'request_right_to_rectification': "To update your personal information, visit 'Account Settings'.",
        'return_policy': "Our return policy allows returns within 30 days for a full refund or exchange.",
        'return_product': "You can return a product by visiting the 'My Orders' section and selecting 'Return'.",
        'return_product_in_store': "You can return products at any of our physical stores.",
        'return_product_online': "You can return products online through the 'My Orders' section.",
        'sales_period': "Our next sales period is coming soon! Keep an eye on our promotions page for updates.",
        'shipping_costs': "Shipping costs vary based on location and order size. You can see the total during checkout.",
        'store_location': "You can find our store locations by visiting the 'Store Locator' section.",
        'store_opening_hours': "Our store opening hours vary by location. You can check the hours on the 'Store Locator' page.",
        'submit_feedback': "We appreciate your feedback! You can submit it through our feedback form on the website.",
        'submit_product_feedback': "Please let us know your thoughts about the product, and we'll take your feedback seriously.",
        'submit_product_idea': "Have an idea for a product? Submit your idea through our product innovation form.",
        'technical_issue': "If you're facing a technical issue, please provide details, and our team will assist you.",
        'track_delivery': "You can track your delivery in the 'My Orders' section.",
        'track_order': "Your order status can be tracked in the 'My Orders' section.",
        'use_app': "Our mobile app is available for download on the App Store and Google Play.",
        'wrong_item': "If you received the wrong item, you can request a replacement through the 'My Orders' section.",
        'unknown': "I'm not sure how to help with that. Could you rephrase your question or ask something else?"
    };

    return responses[intent] || "Sorry, I didn't understand that.";
}




//Redirect to Order when item clicked on home
const dish1 = document.querySelector('.dish1');
dish1.addEventListener('click', function() {
window.location.href = "order.php";
});

const dish2 = document.querySelector('.dish2');
dish2.addEventListener('click', function() {
window.location.href = "order.php";
});

const dish3 = document.querySelector('.dish3');
dish3.addEventListener('click', function() {
window.location.href = "order.php";
});

