import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { Product } from 'src/app/models/product';


@Injectable({
  providedIn: 'root'
})
export class WishlistService {
  public products: Product[] = [];

  public observable: BehaviorSubject<any> = new BehaviorSubject(0);
  
  constructor() {  }

  addToWishlist(product: Product) {
    this.products.push(product);
    product.wished = true;
    localStorage.setItem("w:" + product.id, "true");
    this.observable.next(product.id);
  }

  getProductsCount(): number {
    return this.products.length;
  }
}
