import { Component, OnInit, Input } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { Product } from 'src/app/models/product';
import { ProductsService } from 'src/app/services/productsService/products.service';

@Component({
  selector: 'app-product-details',
  templateUrl: './product-details.component.html',
  styleUrls: ['./product-details.component.scss']
})
export class ProductDetailsComponent implements OnInit {
  public id: string;
  public products: Product[];
  public product: Product;
  constructor(private productsService: ProductsService, private router: Router, private route: ActivatedRoute) { }

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
}
