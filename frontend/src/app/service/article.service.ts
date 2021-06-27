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

    return this.http.get<ArticleModel[]>('api/article', {headers});
  }

  public get(articleId: number, token?: string): Observable<ArticleModel> {
    let headers = new HttpHeaders()
    headers = undefined !== token ? headers.append('x-auth-token', token) : headers;

    return this.http.get<ArticleModel>(`api/article/${articleId}`, {headers});
  }

  public update(articleId: number, article: ArticleModel, token: string): Observable<ArticleModel> {
    const headers = new HttpHeaders({'x-auth-token': token, 'Access-Control-Allow-Origin': '*'});

    return this.http.put<ArticleModel>(`api/article/${articleId}`, {title: article.title, content: article.content}, {headers});
  }

  public create(article: ArticleModel, token: string): Observable<ArticleModel> {
    const headers = new HttpHeaders({'x-auth-token': token, 'Access-Control-Allow-Origin': '*'});
    return this.http.post<ArticleModel>(`api/article`, {title: article.title, content: article.content}, {headers})
  }

  public delete(articleId: number, token: string): Observable<{success: boolean}> {
    const headers = new HttpHeaders({'x-auth-token': token, 'Access-Control-Allow-Origin': '*'});

    return this.http.delete<{success: boolean}>(`api/article/${articleId}`, {headers});
  }

}
