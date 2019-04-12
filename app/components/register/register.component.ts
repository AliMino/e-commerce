import { Component, OnInit } from '@angular/core';
import { FormControl, Validators, FormGroup, FormBuilder } from '@angular/forms';
import { MustMatch } from 'src/app/models/passwordValidator';
import { Router } from '@angular/router';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {

  registerForm: FormGroup;
  submitted = false;
  message = '';

  constructor(private formBuilder: FormBuilder, private router:Router) { }

  ngOnInit() {
    this.registerForm = this.formBuilder.group({
      userName: ['', Validators.required],
      password: ['', [Validators.required, Validators.minLength(6)]],
      confirm_password: ['', Validators.required]
    }, {
        validator: MustMatch('password', 'confirm_password')
      });
  }




  onSubmit() {
    if (this.registerForm.status == "VALID") {

      console.log("Validated successfully")
      let user = {
        "userName": this.registerForm.value.userName,
        "password": this.registerForm.value.password
      };
      // alert("you registered successfully !!");
      // this.router.navigate(['login']);
      localStorage.setItem(user.userName, JSON.stringify(user));
      this.message = "You've registered successfully!";
    } else {
      console.log("invalid registration")
      console.log(this.registerForm);
    }
  }

}