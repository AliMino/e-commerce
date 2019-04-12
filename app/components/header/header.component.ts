import { Component, OnInit, Input } from '@angular/core';
import { Product } from 'src/app/models/product';
import { LoginService } from 'src/app/services/loginService/login.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {
  @Input() product: Product;

  constructor(private loginService: LoginService) { }

  ngOnInit() {
  }

  isRegisteredUser(): boolean {
    return this.loginService.isRegisteredUser();
  }

}