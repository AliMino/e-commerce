import { Injectable } from '@angular/core';
import { Product } from '../../models/product';


@Injectable({
  providedIn: 'root'
})
export class ProductsService {
    products: Product[] =  [
        {
            "id": "HT-1002",
            "category": "Computer Systems",
            "description": "Notebook Basic 18 with 2,80 GHz quad core, 18\" LCD, 8 GB DDR3 RAM, 1000 GB Hard Disc, Windows 8 Pro",
            "name": "Flat Future",
            "picUrl": "https://openui5.hana.ondemand.com/test-resources/sap/ui/documentation/sdk/images/HT-1002.jpg",
            "price": 956,
            "wished": false
        },
        {
            "id": "HT-1001",
            "category": "Computer Systems",
            "description": "Notebook Basic 17 with 2,80 GHz quad core, 17\" LCD, 4 GB DDR3 RAM, 500 GB Hard Disc, Windows 8 Pro",
            "name": "Flat XL",
            "picUrl": "https://openui5.hana.ondemand.com/test-resources/sap/ui/documentation/sdk/images/HT-1001.jpg",
            "price": 456,
            "wished": false
        },
        {
            "id": "HT-1040",
            "category": "Printers & Scanners",
            "description": "Print 2400 dpi image quality color documents at speeds of up to 32 ppm (color) or 36 ppm (monochrome), letter/A4. Powerful 500 MHz processor, 512MB of memory",
            "name": "Laser Professional Eco",
            "picUrl": "https://openui5.hana.ondemand.com/test-resources/sap/ui/documentation/sdk/images/HT-1040.jpg",
            "price": 786,
            "wished": false
        },
        {
            "id": "HT-1041",
            "category": "Printers & Scanners",
            "description": "Up to 22 ppm color or 24 ppm monochrome A4/letter, powerful 500 MHz processor and 128MB of memory",
            "name": "Laser Basic",
            "picUrl": "https://openui5.hana.ondemand.com/test-resources/sap/ui/documentation/sdk/images/HT-1041.jpg",
            "price": 257,
            "wished": false
        },
        {
            "id": "HT-1042",
            "category": "Printers & Scanners",
            "description": "Print up to 25 ppm letter and 24 ppm A4 color or monochrome, with Available first-page-out-time of less than 13 seconds for monochrome and less than 15 seconds for color",
            "name": "Laser Allround",
            "picUrl": "https://openui5.hana.ondemand.com/test-resources/sap/ui/documentation/sdk/images/HT-1042.jpg",
            "price": 95,
            "wished": false
        },
        {
            "id": "HT-1050",
            "category": "Printers & Scanners",
            "description": "4800 dpi x 1200 dpi - up to 35 ppm (mono) / up to 34 ppm (color) - capacity: 250 sheets - Hi-Speed USB, Ethernet",
            "name": "Ultra Jet Super Color",
            "picUrl": "https://openui5.hana.ondemand.com/test-resources/sap/ui/documentation/sdk/images/HT-1050.jpg",
            "price": 56,
            "wished": false
        },
        {
            "id": "HT-1011",
            "category": "Computer Systems",
            "description": "Notebook Professional 17 with 2,80 GHz quad core, 17\" Multitouch LCD, 8 GB DDR3 RAM, 500 GB SSD - DVD-Writer (DVD-R/+R/-RW/-RAM),Windows 8 Pro",
            "name": "Ultra Jet Mobile",
            "picUrl": "https://openui5.hana.ondemand.com/test-resources/sap/ui/documentation/sdk/images/HT-1011.jpg",
            "price": 586,
            "wished": false
        },
        {
            "id": "HT-1000",
            "category": "Computer Systems",
            "description": "4800 dpi x 1200 dpi - up to 35 ppm (mono) / up to 34 ppm (color) - capacity: 250 sheets - Hi-Speed USB2.0, Ethernet",
            "name": "Ultra Jet Super Highspeed",
            "picUrl": "https://openui5.hana.ondemand.com/test-resources/sap/ui/documentation/sdk/images/HT-1000.jpg",
            "price": 256,
            "wished": false
        },
        {
            "id": "HT-1010",
            "category": "Computer Systems",
            "description": "Notebook Professional 15 with 2,80 GHz quad core, 15\" Multitouch LCD, 8 GB DDR3 RAM, 500 GB SSD - DVD-Writer (DVD-R/+R/-RW/-RAM),Windows 8 Pro",
            "name": "Multi Print",
            "picUrl": "https://openui5.hana.ondemand.com/test-resources/sap/ui/documentation/sdk/images/HT-1010.jpg",
            "price": 127,
            "wished": false
        }
      ];  

  constructor() { }

  getProducts(): Product[] {
    return this.products;
  }

  setProducts(products: Product[]) {
      this.products = products;
  }
}
