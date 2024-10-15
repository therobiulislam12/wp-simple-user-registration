const wrapper = document.querySelector(".wrapper");
const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("form.login");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector("form .signup-link span");
const loginLink = document.querySelector("form .login-link span");
signupBtn.onclick = () => {
  loginForm.style.marginLeft = "-50%";
  loginText.style.marginLeft = "-50%";
  wrapper.style.height = "100%";
};
loginBtn.onclick = () => {
  loginForm.style.marginLeft = "0%";
  loginText.style.marginLeft = "0%";
  wrapper.style.height = "500px";
};
signupLink.onclick = () => {
  signupBtn.click();
  return false;
};
loginLink.onclick = () => {
  loginBtn.click();
  return false;
};
