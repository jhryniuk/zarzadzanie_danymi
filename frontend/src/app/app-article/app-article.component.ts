import {Component, OnInit} from "@angular/core";
import {ArticleModel} from "../model/article.model";
import {ArticleService} from "../service/article.service";
import {ActivatedRoute, Router} from "@angular/router";

@Component({
  templateUrl: './app-article.component.html',
  styleUrls: ['./app-article.component.scss']
})
export class AppArticleComponent implements OnInit {
  public editMode = false;
  public id: number | null = null;
  public article: ArticleModel = {} as ArticleModel;

  constructor(
    private articleService: ArticleService,
    private route: ActivatedRoute,
    private router: Router
  ) {
    this.id = parseInt(this.route.snapshot.paramMap.get('article'), 10);
  }

  public remove(): void {
    this.articleService.delete(this.article.id, '10XODBZ5yfdefkCIYCRF8Z4VEYe0aQPR67KsfdDlFMo').subscribe(() => {
      this.router.navigateByUrl('/');
    })
  }

  public saveEdit(): void {
    this.articleService.update(this.article.id, this.article, '10XODBZ5yfdefkCIYCRF8Z4VEYe0aQPR67KsfdDlFMo').subscribe((article: ArticleModel) => {
      this.article = article;
    })
  }
  ngOnInit(): void {
    this.articleService.get(this.id).subscribe((article: ArticleModel) => {
      this.article = article;
    });
  }
}
