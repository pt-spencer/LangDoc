/*
const SignupForm = document.querySelector('#SignUp');
SignupForm.addEventListener("submit", e => {
	e.preventDefault();
	
	//get user info
	const email = SignupForm["signupUsername"].value;
	const password = SignupForm["signupPassword"].value;
	
	//sign up user
	auth.createUserWithEmailAndPassword(email, password).then(cred => {
		console.log(cred.user);
		const modal = document.querySelector("#SignUp");
		M.Modal.getInstance(modal).close();
		SignupForm.reset();
	})
});
*/

import { getAuth, createUserWithEmailAndPassword } from "firebase/auth";

const SignupForm = document.querySelector('#SignUp');
SignupForm.addEventListener("submit", e => {
	e.preventDefault();
	
	//get user info
	const email = SignupForm["signupUsername"].value;
	const password = SignupForm["signupPassword"].value;
	
const auth = getAuth();
createUserWithEmailAndPassword(auth, email, password)
  .then((userCredential) => {
    // Signed in 
    const user = userCredential.user;
    // ...
  })
  .catch((error) => {
    const errorCode = error.code;
    const errorMessage = error.message;
    // ..
  });