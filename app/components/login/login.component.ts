import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validator, Validators, ControlValueAccessor } from '@angular/forms';
import { Router } from '@angular/router';
import { LoginService } from 'src/app/services/loginService/login.service';
// import { LoginService } from 'src/app/services/login.service';
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  errorMessage: string = "";
  public LoginForm = new FormGroup({
    userName: new FormControl('', [Validators.required, Validators.minLength(4)]),
    password: new FormControl('', [Validators.required, Validators.minLength(4)]),

  });
  constructor(private user: LoginService, private router: Router) { }

  ngOnInit() {
  }
  onSubmit(): void {
    if (this.LoginForm.status == "VALID") {
      let storageUser = JSON.parse(localStorage.getItem(this.LoginForm.value.userName));
      
      if (storageUser) {
        if (storageUser.userName != this.LoginForm.value.userName || storageUser.password != this.LoginForm.value.password) {
          this.errorMessage = "Invalid  UserName or Password";
        } else {

          localStorage.setItem('currentUser', JSON.stringify(this.LoginForm.value.userName));
          this.user.setUsername(this.LoginForm.value.userName);
          this.router.navigate([""]);
        }
      }
      else {
        this.errorMessage = "Invalid Username or password";
      }
    }
  }
}