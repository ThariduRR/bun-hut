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
            const botMessage = data.intent || "Sorry, I didn't understand that.";

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
    messagesContainer.scrollTop = messagesContainer.scrollHeight; // Scroll to bottom
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

