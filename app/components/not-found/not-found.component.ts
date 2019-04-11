import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-not-found',
  templateUrl: './not-found.component.html',
  styleUrls: ['./not-found.component.scss']
})
export class NotFoundComponent implements OnInit {
  public imgLink = "https://onextrapixel.com/wp-content/uploads/2017/04/404-pages.jpg";

  constructor() { }

  ngOnInit() {
  }

}
