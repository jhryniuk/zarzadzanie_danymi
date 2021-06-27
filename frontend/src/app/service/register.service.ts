import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Observable} from "rxjs";
import {UserModel} from "../model/user.model";
import {Injectable} from "@angular/core";

@Injectable()
export class RegisterService {
  constructor(private http: HttpClient) {
  }

  public register(user: UserModel): Observable<UserModel> {
    const headers = new HttpHeaders({'Access-Control-Allow-Origin': '*'});
    return this.http.post<UserModel>('auth/register', user, {headers});
  }
}
