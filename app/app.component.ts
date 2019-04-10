import { Component, OnInit } from '@angular/core';
import { Product } from 'src/app/models/product';
import { ProductsService } from 'src/app/services/productsService/products.service';
import { WishlistService } from 'src/app/services/wishListService/wishlist.service';
import { CartService } from './services/cartService/cart.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  title = 'e-commerce';
  products: Product[];

  constructor(
    private productsService: ProductsService,
    private wishlistService: WishlistService,
    private cartService: CartService) {  }
  
  ngOnInit() {
    this.products = this.productsService.getProducts();
    this.products.forEach((product) => {
      product.wished = JSON.parse(localStorage.getItem("w:" + product.id)) || false;
      if(product.wished) this.wishlistService.products.push(product);
      this.cartService.productsInCart = JSON.parse(localStorage.getItem("cart"));
    });
    this.productsService.setProducts(this.products);
  }
}
