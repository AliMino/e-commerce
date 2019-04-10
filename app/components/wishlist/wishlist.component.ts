import { Component, OnInit } from '@angular/core';
import { WishlistService } from 'src/app/services/wishListService/wishlist.service';

@Component({
  selector: 'app-wishlist',
  templateUrl: './wishlist.component.html',
  styleUrls: ['./wishlist.component.scss']
})
export class WishlistComponent implements OnInit {
  wishedProductsCount: number = 0;

  constructor(private wishlistService: WishlistService) {
  }
  
  ngOnInit() {
    this.wishlistService.observable.subscribe(() => this.wishedProductsCount = this.wishlistService.getProductsCount());
  }

}
