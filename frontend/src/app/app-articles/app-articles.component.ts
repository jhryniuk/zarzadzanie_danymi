import {Component, OnInit} from "@angular/core";
import {ArticleService} from "../service/article.service";
import {ArticleModel} from "../model/article.model";

@Component({
  templateUrl: './app-articles.component.html',
  styleUrls: ['./app-articles.component.scss']
})
export class AppArticlesComponent implements OnInit {
  public articles: ArticleModel[] = [];
  public newArticle: ArticleModel = {} as ArticleModel;
  public showAddArticle = false;
  constructor(private articleService: ArticleService) {
  }

  public saveNewArticle(): void {
    this.articleService.create(this.newArticle, '10XODBZ5yfdefkCIYCRF8Z4VEYe0aQPR67KsfdDlFMo').subscribe(() => {
      this.articleService.query().subscribe((articles: ArticleModel[]) => {
        this.articles = articles;
      })
    })
  }

  ngOnInit(): void {
    this.articleService.query().subscribe((articles: ArticleModel[]) => {
      this.articles = articles;
    }, (error) => {
      console.log(error);
    });
  }
}
