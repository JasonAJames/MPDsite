import {Component} from 'angular2/core';
import {Config} from './config.service';
import {Product} from './product';
import {HeaderComponent} from './header.component';

@Component({
    selector: 'my-app',
    templateUrl: 'app/ts/app.component.html',
    directives: [AppComponent]
})

export class AppComponent {
    mainHeading = Config.MAIN_HEADING;
    
}
