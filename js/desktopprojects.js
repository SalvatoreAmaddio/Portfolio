//const carousel1 = new Carousel("Carousel1",1);

description = "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Incidunt quisquam soluta fugit voluptas molestias neque! Fuga unde quas quia blanditiis!"
"Deserunt nisi pariatur aspernatur nostrum cumque id est laudantium expedita iusto temporibus. Sed autem, doloribus eligendi fugit ab similique nisi."
"Reiciendis, quae neque doloribus minima omnis harum rem error? Dolor at voluptates alias non, quaerat quam tenetur sed quisquam cupiditate?"
"Corrupti id cumque aliquid beatae odio vero qui? Dolor molestias eius reprehenderit laudantium ab accusamus, iste provident voluptates similique nisi."
"Quis suscipit provident eveniet ad, maxime consequuntur ut qui sed minus nam recusandae ipsum numquam porro exercitationem sint, vitae possimus?"
"Porro earum, dolorum est consequuntur quibusdam velit laborum. Porro dolor accusantium perferendis ad exercitationem numquam voluptatum similique dolorum obcaecati ab!"
"Nostrum soluta praesentium quos id, tempore voluptate cupiditate nihil veritatis quas fugit molestiae. Fugit dolores quidem tenetur blanditiis? Commodi, minus?"
"Beatae dolor, quibusdam architecto provident illum repellendus eaque ipsam necessitatibus unde magnam commodi numquam vel, minus ratione aliquam esse fuga!"
"Dolorum placeat aperiam ullam omnis necessitatibus hic rem expedita aspernatur repudiandae perspiciatis porro, in quibusdam at nisi suscipit illum est."
"Corrupti, a. Vel saepe facilis nemo quaerat, sint voluptas fuga ad ut nostrum adipisci tempora corporis aliquam impedit dicta ratione?";

let Images=
[
    new SlideImage("https://www.w3schools.com/howto/img_woods_wide.jpg","The Woods"), 
    new SlideImage("https://www.w3schools.com/howto/img_snow.jpg","Mountain")
];

const Projects = 
[
    new Project("Betting","Peter Randall","2023","DesktopProjects/Betting.ico",["Excel","Multi-Users"],"blablabla some text",Images,ProjectType.Desktop),
    new Project("Meter","Rudy Willy","2022","DesktopProjects/Meter.ico",["Excel","PDF"],"blablabla some text",Images,ProjectType.Desktop),
]

Project.DuplicateProject(Projects);



