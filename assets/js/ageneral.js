// showing profile option
const profileOptions = document.querySelector(".profile-options");
const profileBtn = document.querySelector(".profile-btn");

if (profileBtn && profileOptions) {
    profileBtn.addEventListener("click", () => {
        if (profileOptions.style.display === "none") {
            profileOptions.style.display = "flex";
            if (notificationList) notificationList.style.display = "none";
        } else {
            profileOptions.style.display = "none";
        }
    });
}

// showing notification list
const notificationList = document.querySelector(".notification-list");
const notifButton = document.querySelector(".notif-button");

if (notifButton && notificationList) {
    notifButton.addEventListener("click", () => {
        if (notificationList.style.display === "none") {
            notificationList.style.display = "block";
            if (profileOptions) profileOptions.style.display = "none";
        } else {
            notificationList.style.display = "none";
        }
    });
}
