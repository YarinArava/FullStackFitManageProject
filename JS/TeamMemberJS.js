

const profilePic = document.querySelector('.profile-pic');
profilePic.addEventListener('mouseenter', () => {
    document.querySelector('h2').innerText = "Nice to meet you!";
});
profilePic.addEventListener('mouseleave', () => {
    document.querySelector('h2').innerText = "Hello!";
});

window.addEventListener('load', () => {
    profilePic.style.opacity = 0;
    profilePic.style.transition = "opacity 2s ease";
    setTimeout(() => profilePic.style.opacity = 1, 600);
});