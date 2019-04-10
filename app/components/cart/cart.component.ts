import { Component, OnInit } from '@angular/core';
import { CartService } from 'src/app/services/cartService/cart.service';
import { ProductsService } from 'src/app/services/productsService/products.service';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.scss']
})
export class CartComponent implements OnInit {
  public purchasedProductsCount: number = 0;

  constructor(private productsService: ProductsService, private cartService: CartService) { }

  ngOnInit() {
    this.cartService.observable.subscribe(() => this.purchasedProductsCount = this.cartService.getProductsCount());
  }

  getCart() {
    let result = [];
    this.productsService.products.forEach((product) => {
      if(this.cartService.productsInCart[product.id] > 0)
        result.push(product.name);
    });
    return result;
  }
}
