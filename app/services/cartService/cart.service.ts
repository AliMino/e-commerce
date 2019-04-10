import { Injectable } from '@angular/core';
import { Product } from 'src/app/models/product';
import { BehaviorSubject } from 'rxjs';
import { ProductsService } from '../productsService/products.service';

@Injectable({
  providedIn: 'root'
})
export class CartService {
  public productsInCart: Object = {};
  

  public observable: BehaviorSubject<any> = new BehaviorSubject(0);

  constructor(private productsService: ProductsService) {
    this.initializeCart();
  }

  addToCart(product: Product) {
    this.productsInCart[product.id]++;
    this.observable.next(this.getProductsCount());
    localStorage.setItem("cart", JSON.stringify(this.productsInCart));
  }

  getProductsCount(): number {
    let count = 0;
    this.productsService.products.forEach((product) => count += this.productsInCart[product.id]);
    return count;
  }

  initializeCart() {
    this.productsService.products.forEach((product) => this.productsInCart[product.id] = 0);
    if(!localStorage.getItem("cart"))
      localStorage.setItem("cart", JSON.stringify(this.productsInCart));
  }

  removeProduct(productId: string): void {
    this.productsInCart[productId] = 0;
    localStorage.setItem("cart", JSON.stringify(this.productsInCart));
  }
}
