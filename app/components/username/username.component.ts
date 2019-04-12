import { Component, OnInit } from '@angular/core';
import { LoginService } from 'src/app/services/loginService/login.service';
import { BehaviorSubject } from 'rxjs';

@Component({
  selector: 'app-username',
  templateUrl: './username.component.html',
  styleUrls: ['./username.component.scss']
})
export class UsernameComponent implements OnInit {
  
  public userName: string;

  constructor(private user: LoginService) {

    this.user.getUsername().subscribe(response => {
      let currentUser = JSON.parse(localStorage.getItem("currentUser"));
      console.log("1", currentUser);
      let user = '';
      if (currentUser) {
        user = currentUser.userName;
      }
      if (response == "Guest")
        this.userName = "Guest";
      else
        this.userName = response;
    });
  }
  ngOnInit() {
  }

}