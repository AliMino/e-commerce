import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class LoginService {
  public username: BehaviorSubject<string> = new BehaviorSubject('guest');

  constructor() {
    const user = localStorage.getItem("currentUser");
    if(user)
      this.username = new BehaviorSubject(JSON.parse(user));
  }

  getUsername(): Observable<string> {
    return this.username.asObservable();
  }

  setUsername(name: string): void {
    this.username.next(name);
  }

  isRegisteredUser(): boolean {
    console.log(this.username.getValue());
    return this.username.getValue() != 'guest';
  }

  
}
