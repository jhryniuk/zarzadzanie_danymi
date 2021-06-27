import {Component} from "@angular/core";
import {UserModel} from "../model/user.model";
import {RegisterService} from "../service/register.service";
import {Router} from "@angular/router";

@Component({
  templateUrl: './app-register.component.html',
  styleUrls: ['./app-register.component.scss']
})
export class AppRegisterComponent {
  constructor(private registerService: RegisterService, private router: Router) {
  }
  public newUser: UserModel = {} as UserModel;

  public register(): void {
    this.registerService.register(this.newUser).subscribe(() => {
      this.router.navigateByUrl('/');
    }, () => {
      this.router.navigateByUrl('/');
    });
  }
}
