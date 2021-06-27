import {Component, OnInit} from "@angular/core";
import {ArticleService} from "../service/article.service";
import {ArticleModel} from "../model/article.model";

@Component({
  templateUrl: './app-articles.component.html',
  styleUrls: ['./app-articles.component.scss']
})
export class AppArticlesComponent implements OnInit {
  public articles: ArticleModel[] = [];
  constructor(private articleService: ArticleService) {
  }

  ngOnInit(): void {
    this.articleService.query().subscribe((articles: ArticleModel[]) => {
      this.articles = articles;
    }, (error) => {
      console.log(error);
    });
  }
}
