import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { LoginService } from 'src/app/services/loginService/login.service';

@Component({
  selector: 'app-logout',
  templateUrl: './logout.component.html',
  styleUrls: ['./logout.component.scss']
})
export class LogoutComponent implements OnInit {

  constructor(private router: Router, private loginService: LoginService) { }

  ngOnInit() {
  }

  logout(): void {
    let answer = confirm('Are you sure you want to Logout?');
    if (answer) {
      localStorage.removeItem('currentUser');
      this.loginService.setUsername('Guest');
      this.router.navigate(['/login']);
    } else {
      this.router.navigate(['home']);
    }
  }

}