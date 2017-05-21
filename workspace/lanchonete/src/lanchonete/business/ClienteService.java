package lanchonete.business;

import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.List;

import lanchonete.DAO.ClienteDao;
import lanchonete.model.ClienteModel;
import lanchonete.model.PedidoModel;
import lanchonete.view.ClienteView;

public class ClienteService {

	public void listarCliente() {
		ClienteDao dao = new ClienteDao();
		try {
			List<ClienteModel> lista = dao.listarClientes();
			if (!lista.isEmpty()) {
				ClienteView clienteView = new ClienteView();
				clienteView.listarCliente(lista);
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	public List<ClienteModel> getCliente(BigDecimal codCliente) {
		ClienteDao dao = new ClienteDao();
		List<ClienteModel> lista = new ArrayList<>();
		try {
			ClienteModel c = dao.getCliente(codCliente);
			if (c.getCodigoCliente() != null) {
				lista.add(c);
			}

		} catch (Exception e) {
			e.printStackTrace();
		}
		return lista;
	}

	public int salvarCliente(ClienteModel clienteCad) {
		ClienteDao dao = new ClienteDao();
		int retorno = 0;
		try {
			retorno = dao.salvarCliente(clienteCad);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}

	public int excluirCliente(BigDecimal codCliente) {

		ClienteDao dao = new ClienteDao();
		int retorno = 0;
		try {
			retorno = dao.deletarCliente(codCliente);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}

	public int editarCliente(ClienteModel c) {
		ClienteDao dao = new ClienteDao();
		int retorno = 0;
		try {
			retorno = dao.updateCliente(c);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}

	public List<PedidoModel> buscarHistoricoPedidosCliente(BigDecimal codCliente) {
		ClienteDao dao = new ClienteDao();
		List<PedidoModel> lista = new ArrayList<PedidoModel>();
		try {
			lista = dao.getHistoricoCliente(codCliente);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return lista;
	}
}
