import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
import { ProductsComponent } from './components/products/products.component';
import { SingleProductComponent } from './components/single-product/single-product.component';
import { ProductDetailsComponent } from './components/product-details/product-details.component';
import { WishlistComponent } from './components/wishlist/wishlist.component';
import { CartComponent } from './components/cart/cart.component';
import { NavigationComponent } from './components/navigation/navigation.component';
import { CheckoutComponent } from './components/checkout/checkout.component';
import { NotFoundComponent } from './components/not-found/not-found.component';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { LoginComponent } from './components/login/login.component';
import { LogoutComponent } from './components/logout/logout.component';
import { RegisterComponent } from './components/register/register.component';
import { UsernameComponent } from './components/username/username.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    ProductsComponent,
    SingleProductComponent,
    ProductDetailsComponent,
    WishlistComponent,
    CartComponent,
    NavigationComponent,
    CheckoutComponent,
    NotFoundComponent,
    LoginComponent,
    LogoutComponent,
    RegisterComponent,
    UsernameComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ReactiveFormsModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
