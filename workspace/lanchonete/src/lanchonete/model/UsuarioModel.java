package lanchonete.model;

public class UsuarioModel {

	private String nome_user;
	private String cpf_user;
	private String login_user;
	private String senha_user;
	private int perfil_user;
	private int cod_user;

	public String getNome_user() {
		return nome_user;
	}

	public void setNome_user(String nome_user) {
		this.nome_user = nome_user;
	}

	public String getCpf_user() {
		return cpf_user;
	}

	public void setCpf_user(String cpf_user) {
		this.cpf_user = cpf_user;
	}

	public String getLogin_user() {
		return login_user;
	}

	public void setLogin_user(String login_user) {
		this.login_user = login_user;
	}

	public String getSenha_user() {
		return senha_user;
	}

	public void setSenha_user(String senha_user) {
		this.senha_user = senha_user;
	}

	public int getPerfil_user() {
		return perfil_user;
	}

	public void setPerfil_user(int perfil_user) {
		this.perfil_user = perfil_user;
	}

	public int getCod_user() {
		return cod_user;
	}

	public void setCod_user(int cod_user) {
		this.cod_user = cod_user;
	}
}
