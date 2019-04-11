import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { Product } from 'src/app/models/product';
import { ProductsService } from '../productsService/products.service';


@Injectable({
  providedIn: 'root'
})
export class WishlistService {
  public products: Product[] = [];

  public observable: BehaviorSubject<any> = new BehaviorSubject(0);
  
  constructor(private productsService: ProductsService) {  }

  addToWishlist(product: Product): void {
    this.products.push(product);
    product.wished = true;
    localStorage.setItem("w:" + product.id, "true");
    this.observable.next(product.id);
  }

  getProductsCount(): number {
    return this.products.length;
  }

  removeFromWishlist(product: Product): void {
    this.productsService.products.forEach((p) => {
      if(this.products.indexOf(product) != -1) {
        this.products.splice(this.products.indexOf(product), 1);
        localStorage.removeItem("w:" + p.id);
      }
    })
  }
}
