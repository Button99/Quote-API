{ pkgs }: {
	deps = [
		pkgs.php80Packages.composer
  pkgs.php74
    pkgs.php74Extensions.pdo
    pkgs.sqlite
	];
}