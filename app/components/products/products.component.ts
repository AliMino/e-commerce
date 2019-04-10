import { Component, OnInit } from '@angular/core';
import { ProductsService } from 'src/app/services/productsService/products.service';
import { Product } from 'src/app/models/product';
import { WishlistService } from 'src/app/services/wishListService/wishlist.service';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.scss']
})
export class ProductsComponent implements OnInit {
  public products:Product[];

  constructor(private productsService: ProductsService, private wishlistService: WishlistService) { }

  ngOnInit() {
    this.products = this.productsService.getProducts();
  }

}
