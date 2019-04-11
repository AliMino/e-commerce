import { Component, OnInit } from '@angular/core';
import { WishlistService } from 'src/app/services/wishListService/wishlist.service';
import { Product } from 'src/app/models/product';
import { CartService } from 'src/app/services/cartService/cart.service';

@Component({
  selector: 'app-wishlist',
  templateUrl: './wishlist.component.html',
  styleUrls: ['./wishlist.component.scss']
})
export class WishlistComponent implements OnInit {
  wishedProductsCount: number = 0;
  wishedProducts: Product[] = [];

  constructor(
    private wishlistService: WishlistService,
    private cartService: CartService
    ) { }
  
  ngOnInit() {
    this.wishlistService.observable.subscribe(() => this.wishedProductsCount = this.wishlistService.getProductsCount());
  }

  getWishedProducts(): Product[] {
    return this.wishlistService.products;
  }

  updateWishlist(): void {
    this.wishedProducts = this.getWishedProducts();
    this.wishedProductsCount = this.wishlistService.getProductsCount();
  }

  addTocart(product: Product): void {
    this.cartService.addToCart(product);
    this.updateWishlist();
  }

  removeFromWishlist(product: Product): void {
    this.wishlistService.removeFromWishlist(product);
    this.updateWishlist();
  }

}
