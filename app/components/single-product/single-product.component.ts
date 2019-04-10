import { Component, OnInit, Input } from '@angular/core';
import { Product } from 'src/app/models/product';
import { WishlistService } from 'src/app/services/wishListService/wishlist.service';
import { CartService } from 'src/app/services/cartService/cart.service';

@Component({
  selector: 'app-single-product',
  templateUrl: './single-product.component.html',
  styleUrls: ['./single-product.component.scss']
})
export class SingleProductComponent implements OnInit {
  @Input() product: Product;
  
  constructor(private wishlistService: WishlistService, private cartService: CartService) { }

  ngOnInit() {
  }

  wishClicked() {
    if(this.wishlistService.products.indexOf(this.product) == -1)
      this.wishlistService.addToWishlist(this.product);
    else alert('you have already added this product to wishlist!');
  }

  cartClicked() {
    this.cartService.addToCart(this.product);
  }

}
