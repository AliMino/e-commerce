import { Component, OnInit } from '@angular/core';
import { CartService } from 'src/app/services/cartService/cart.service';
import { ProductsService } from 'src/app/services/productsService/products.service';
import { Product } from 'src/app/models/product';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.scss']
})
export class CartComponent implements OnInit {
  public purchasedProductsCount: number = 0;
  private cart_products: Product[] = [];

  constructor(private productsService: ProductsService, private cartService: CartService) { }

  ngOnInit() {
    this.cartService.observable.subscribe(() => this.purchasedProductsCount = this.cartService.getProductsCount());
  }
  
  updateCartModal() {
    this.cart_products.splice(0, this.cart_products.length);
    this.productsService.products.forEach((product) => {
      if(this.cartService.productsInCart[product.id] > 0)
        this.cart_products.push(product);
    });
    console.table(this.cart_products);
  }

  getQuantity(product: Product): number {
    return this.cartService.productsInCart[product.id];
  }

  getTotalPrice(): number {
    let price = 0;
    this.productsService.products.forEach((product) => price += this.cartService.productsInCart[product.id] * product.price);
    return price;
  }

  removeFromCart(productId: string): void {
    this.cartService.removeProduct(productId);
    this.cart_products.forEach((product) => {
      if(product.id == productId)
        this.cart_products.splice(this.cart_products.indexOf(product), 1);
    });
    
  }
}
