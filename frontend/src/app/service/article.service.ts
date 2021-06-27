import {Injectable} from "@angular/core";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Observable} from "rxjs";
import {ArticleModel} from "../model/article.model";

@Injectable()
export class ArticleService {
  constructor(private http: HttpClient) {
  }

  public query(token?: string): Observable<ArticleModel[]> {
    let headers = new HttpHeaders();
    headers = undefined !== token ? headers.append('x-auth-token', token) : headers;

    return this.http.get<ArticleModel[]>('http://10.5.0.3/article', {headers});
  }

  public get(articleId: number, token?: string): Observable<ArticleModel> {
    let headers = new HttpHeaders()
    headers = undefined !== token ? headers.append('x-auth-token', token) : headers;

    return this.http.get<ArticleModel>(`http://10.5.0.3/article/${articleId}`, {headers});
  }

  public update(articleId: number, article: ArticleModel, token: string): Observable<ArticleModel> {
    const headers = new HttpHeaders({'x-auth-token': token});

    return this.http.put<ArticleModel>(`http://10.5.0.3/article/${articleId}`, article, {headers});
  }

}
