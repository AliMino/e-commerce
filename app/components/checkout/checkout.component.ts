import { Component, OnInit } from '@angular/core';
import { CartService } from 'src/app/services/cartService/cart.service';
import { Product } from 'src/app/models/product';
import { ProductsService } from 'src/app/services/productsService/products.service';

@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.scss']
})
export class CheckoutComponent implements OnInit {
  public productsInCart: Product[] = [];

  constructor(private productsService: ProductsService, private cartService: CartService) { }

  ngOnInit() {
    this.productsService.products.forEach((product) => {
      if(this.getQuantity(product) > 0)
        this.productsInCart.push(product);
    });
  }

  getQuantity(product: Product): number {
    return this.cartService.productsInCart[product.id];
  }

  getTotalPrice(): number {
    return this.cartService.getTotalPrice();
  }

  removeProduct(product: Product): void {
    this.cartService.removeProduct(product.id);
  }
}
