import { Component, OnInit, Input } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { Product } from 'src/app/models/product';
import { ProductsService } from 'src/app/services/productsService/products.service';
import { CartService } from 'src/app/services/cartService/cart.service';
import { WishlistService } from 'src/app/services/wishListService/wishlist.service';

@Component({
  selector: 'app-product-details',
  templateUrl: './product-details.component.html',
  styleUrls: ['./product-details.component.scss']
})
export class ProductDetailsComponent implements OnInit {
  public id: string;
  public products: Product[];
  public product: Product;
  constructor(
    private productsService: ProductsService,
    private cartService: CartService,
    private wishlistService: WishlistService,
    private router: Router,
    private route: ActivatedRoute) { }

  ngOnInit() {
    this.products = this.productsService.getProducts();
    this.id = this.route.params['value'].id;
    this.extractProduct();
  }
  extractProduct() {
    this.products.forEach((product: Product) => {
      if(product.id == this.id)
        this.product = product;
    })
  }

  addToWishlist(): void {
    if(this.wishlistService.products.indexOf(this.product) == -1)
      this.wishlistService.addToWishlist(this.product);
    else alert('you have already added this product to wishlist!');
  }

  addToCart(): void {
    this.cartService.addToCart(this.product);
  }
}
